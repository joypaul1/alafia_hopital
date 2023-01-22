<?php

namespace App\Http\Requests\Purchase;

use App\Helpers\Image;
use App\Helpers\InvoiceNumber;
use App\Models\Account\AccountLedger;
use App\Models\FinancialYearHistory;
use App\Models\Inventory\InventoryItem;
use App\Models\Item\Item;
use App\Models\ItemCount;
use App\Models\Ledger\SupplierLedger;
use App\Models\LedgerTransition;
use App\Models\Purchase\Purchase;
use App\Models\Supplier;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'supplier_id' => 'required',
            'purchase_date' => 'required',
            'receive_date' => 'nullable',
            'purchase_status' => 'required',
            'warehouse_id' => 'required',
            // 'warehouse_id' => 'required',
            'item_id.*' => 'required',
            'purchase_qty.*' => 'required',
            'unit_id.*' => 'required',
            // 'unit_id.*' => 'required',
            'up_before_tax.*' => 'required',
            'subtotal_up_before_tax.*' => 'required',
            'tax_id.*' => 'required',
            'tax_rate.*' => 'required',
            'up_after_tax.*' => 'required',
            'subtotal_up_after_tax.*' => 'required',
            'profit_percent.*' => 'required',
            'un_sell_price.*' => 'required',
            'total_sell_price.*' => 'required',
            'discount_type' => 'nullable',
            'discount_amount' => 'nullable',
            'discount_amount' => 'nullable',
            'pur_dis_amount' => 'nullable',
            'pur_tax_id' => 'nullable',
            'pur_tax_amount' => 'nullable',
            'additional_notes' => 'nullable',
            'shipping_details' => 'nullable',
            'additional_shipping_charge' => 'nullable',
            'pur_sub_total' => 'required',
            'pur_total' => 'required',
            'payment_amount' => 'nullable',
            'paid_date' => 'nullable',
            'payment_method' => 'nullable',
            'payment_account' => 'nullable',
            'due_amount' => 'nullable',
            'payment_note' => 'nullable',
            'file' => 'nullable',

        ];
    }

    public function getInvoiceNumber()
    {
        if (!Purchase::latest()->first()) {
           return 1;
        }else{
            return Purchase::latest()->first()->invoice_number+1;
        }
    }

    public function storeData()
    {
        try {
            DB::beginTransaction();
            $data['invoice_number']     = (new InvoiceNumber)->invoice_num($this->getInvoiceNumber());
            $data['supplier_id']        = $this->supplier_id;
            $data['purchase_date']      = $this->purchase_date;
            $data['note']               = $this->additional_notes;
            $data['lot_number']         = $this->lot_number;
            $data['warehouse_id']       = $this->warehouse_id ;
            $data['purchase_status']    = $this->purchase_status ;
            $data['payment_status']     = ($this->pur_total>$this->payment_amount) ?'Due':'Paid';
            $data['discount_type']      = $this->discount_type ;
            $data['discount_amount']    = $this->pur_dis_amount ;
            $data['tax_amount']         = $this->pur_tax_amount ;
            $data['tax_id']             = $this->pur_tax_id ;
            $data['paid_amount']        = $this->payment_amount ;
            $data['subtotal_amount']    = $this->pur_sub_total ;
            $data['total_amount']       = $this->pur_total ;

            $purchase = Purchase::create($data); //data created here

            // item data
            for ($i=0; $i < count($this->item_id); $i++) {

                $purchase->purchaseItems()->create([
                    'item_id'                   => $this->item_id[$i],
                    'item_variant_id'           => $this->item_variant_id[$i]??null,
                    'purchase_qty'              => $this->purchase_qty[$i]??null,
                    'up_before_tax'             => $this->up_before_tax[$i]??null,
                    'subtotal_up_before_tax'    => $this->subtotal_up_before_tax[$i]??null,
                    'tax_id'                    => $this->tax_id[$i]??null,
                    'tax_rate'                  => $this->tax_rate[$i]??null,
                    'up_after_tax'              => $this->up_after_tax[$i]??null,
                    'subtotal_up_after_tax'     => $this->subtotal_up_after_tax[$i]??null,
                    'un_sell_price'             => $this->un_sell_price[$i]??null,
                    'total_sell_price'          => $this->total_sell_price[$i]??null,
                ]);

                Item::whereId($this->item_id[$i])->update([
                    'unit_id'                  => $this->unit_id[$i]??null,
                    'up_before_tax'             => $this->up_before_tax[$i]??null,
                    'tax_id'                    => $this->tax_id[$i]??null,
                    'tax_rate'                  => $this->tax_rate[$i]??null,
                    'up_after_tax'              => $this->up_after_tax[$i]??null,
                    'profit_percent'            => $this->profit_percent[$i]??null,
                    'sell_price'                => $this->un_sell_price[$i]??null,
                ]);

                ItemCount::updateOrCreate([
                    'item_id' =>$this->item_id[$i]??null,
                    'date'  =>FinancialYearHistory::latest()->first()->start_date
                ],[
                    'pur_qty' => DB::raw('pur_qty +'. $this->purchase_qty[$i]) ,
                ]);

                InventoryItem::updateOrCreate([
                    'warehouses_id' =>$this->warehouse_id,
                    'item_id' =>$this->item_id[$i]??null,
                    'date' =>FinancialYearHistory::latest()->first()->start_date
                ],[
                    'pur_qty' => DB::raw('pur_qty +'. $this->purchase_qty[$i]) ,
                ]);

            }

            //<----start of cash flow Transition------->

            if($this->payment_amount){
                // cashflowTransactions
                $cashflowTransition= $purchase->cashflowTransactions()->create([
                    'url'               => "Backend\Purchase\PurchaseController@show,['id' =>".$purchase->id."]",
                    'cashflow_type'     => 'Purchase',
                    'description'       => 'Purchase Item',
                    'date'              => $this->paid_date??$this->purchase_date,
                    'ledger_id'         => $this->payment_account,
                    'payment_method'    => $this->payment_method,
                ]);

                // cashflowHistories
                $cashflowTransition->cashflowHistory()->create([
                    'credit' => $this->payment_amount
                ]);
            }
            //<----end of cash flow Transition------->

            //<----start of daily book transaction------->

            // dailyTransition
            $dailyTransition = $purchase->dailyTransactions()->create([
                'url'               => "Backend\Purchase\PurchaseController@show,['id' =>".$purchase->id."]",
                'description'       => 'Purchase Item',
                'transaction_type'  => 'Purchase',
                'date'              =>  $this->paid_date??$this->purchase_date,
                'reference_no'      => $purchase->invoice_number,
            ]);

            //purchase full amount
            $dailyTransition->transactionHistories()->create([
                'entry_name' => 'Purchase Item',
                'debit' => $this->pur_total,
            ]);
            if($this->pur_total && ($this->payment_amount > 0) && ($this->pur_total > $this->payment_amount) ){ //partial due amount
                $dailyTransition->transactionHistories()->create([
                    'entry_name' => AccountLedger::find($this->payment_account)->name,
                    'credit' => $this->payment_amount,
                ]);
            }
            if(($this->pur_total && ($this->payment_amount == 0)) ||
                ($this->pur_total && ($this->payment_amount == null)) ){ // full due amount
                $dailyTransition->transactionHistories()->create([
                    'entry_name' => Supplier::whereId($this->supplier_id)->first()->name,
                    'credit' => $this->pur_total,
                ]);
            }
            if(($this->pur_total > $this->payment_amount ) && !($this->pur_total == $this->due_amount)
                && !($this->pur_total == $this->due_amount)
                &&!($this->due_amount == 0)
            ){  //partial due amount
                $dailyTransition->transactionHistories()->create([
                    'entry_name' => Supplier::whereId($this->supplier_id)->first()->name,
                    'credit' => $this->pur_total - $this->payment_amount??0 ,
                ]);
            }
            if($this->pur_total == $this->payment_amount ){ // full paid
                $dailyTransition->transactionHistories()->create([
                    'entry_name' => AccountLedger::find($this->payment_account)->name,
                    'credit' => $this->pur_total ,
                ]);
            }
            //<----end of daily book transaction------->

            //payment Histories
            if($this->payment_amount && $this->payment_account && $this->payment_method){
                $purchase->paymentHistories()->create([
                    'ledger_id' =>$this->payment_account,
                    'payment_method' =>$this->payment_method,
                    'date' =>$this->paid_date,
                    'note' =>$this->payment_note,
                    'paid_amount' =>$this->payment_amount,
                ]);

                // LedgerTransition --->increment costing
                LedgerTransition::updateOrCreate([
                    'ledger_id'=> $this->payment_account,
                    'date'     => FinancialYearHistory::latest()->first()->start_date
                ],[
                    'credit' => DB::raw('credit +'. $this->payment_amount)
                ]);
            }

            // SupplierLedger -->increment Creditor
            if($this->pur_total > $this->payment_amount){
                SupplierLedger::updateOrCreate([
                    'supplier_id'=> $this->supplier_id,
                    'date'     => FinancialYearHistory::latest()->first()->start_date
                ],[
                    'credit' => DB::raw('credit +'. $this->pur_total - $this->payment_amount)
                ]);
            }

            // additional_shipping_charges
            if($this->additional_shipping_charge){
                $purchase->shipmentHistory()->create([
                    'date'      =>  $this->purchase_date,
                    'note'      =>  $this->additional_notes,
                    'details'   =>  $this->shipping_details,
                    'amount'    =>  $this->additional_shipping_charge,
                ]);
            }

            // file
            if($this->hasFile('file')){
                $image =  (new Image)->dirName('purchase')->file($this->file)
                ->resizeImage(200, 200)
                ->save();
                $purchase->documents()->create(['url' => $image]);
            }

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' =>$ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' =>'Data Created Successfully.']);
    }
}
