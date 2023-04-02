<?php

namespace App\Http\Livewire\Backend\Pos;


use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Helpers\InvoiceNumber;
use App\Models\Account\AccountLedger;
use App\Models\FinancialYearHistory;
use App\Models\Item\Unit;
use App\Models\LedgerTransition;
use App\Models\PaymentSystem;
use App\Models\Service\ServiceInvoice;
use App\Models\Service\ServiceName;
use Illuminate\Support\Str;

class Create extends Component
{
    public $brand_id, $userId, $unit_id, $userDetails, $serviceNames, $units, $total, $subTotal, $discount, $discount_type,
        $discount_amount = 0, $invoice_url = null, $taxAmount = 0, $taxId, $cartSubTotal = 0, $itemCount = 0, $serviceNameQty = 0, $cartTotal = 0;
    public $basket = array();
    public $dataTable = array();
    protected $listeners = ['refreshComponent' => '$refresh', 'updateQty'];

    public function mount()
    {
        $this->units   = Unit::active()->select('id', 'name')->get();
        $this->serviceNames = $this->serviceNameQuery();
    }
    public function render()
    {
        return view('livewire.backend.pos.create')->with('basket', $this->basket)
            ->extends('backend.layout.posApp')->section('content');
    }

    public function discountCal($discount_type)
    {
        $this->discount_type = $discount_type;
        // discount type fixed or percentage calculation depends on subtotal
        if ($this->discount_type == 'fixed') {
            $this->discount_amount = $this->discount;
            // $this->cartTotal = $this->cartSubTotal - $this->discount_amount;
        } else {
            $this->discount_amount = ($this->cartSubTotal * $this->discount) / 100;
            // $this->cartTotal = $this->cartSubTotal - $this->discount_amount;
        }
        $this->cartCalculation();
    }

    public function getInvoiceNumber()
    {
        if (!ServiceInvoice::latest()->first()) {
            return 1;
        } else {
            return ServiceInvoice::latest()->first()->invoice_no + 1;
        }
    }

    public function storeData($data)
    {
        if ($this->userId == null) {
            return $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'Please Select Patient']);
        }
        if (count($this->basket) == 0) {
            return  $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'Your Service Is Empty']);
        }

        try {
            DB::beginTransaction();
            //ServiceInvoice
            $serviceInvoice = ServiceInvoice::create([
                'invoice_no'    => (new InvoiceNumber)->invoice_num($this->getInvoiceNumber()),
                'patient_id'           => $this->userId,
                'date'              => date('Y-m-d'),
                'sub_total'         => $this->cartSubTotal,
                'total'             => $this->cartTotal,
                'discount'          => $this->discount,
                'discount_amount'   => $this->discount_amount,
                'discount_type'     => $this->discount_type,
            ]);

            //ServiceInvoice items
            foreach ($this->basket as $itemId => $cartItem) {
                $serviceInvoice->itemDetails()->create([
                    'service_name_id'   => $itemId,
                    'qty'       => $cartItem['qty'],
                    'service_price' => $cartItem['service_price'],
                    'subtotal'  => $cartItem['subtotal'],
                ]);

            }
            //  ServiceInvoice PaymentHistory

            $serviceInvoice->paymentHistories()->create([
                'ledger_id'         => AccountLedger::first()->id,
                'payment_method' => PaymentSystem::first()->name,
                'payment_system_id' => PaymentSystem::first()->id, //6
                'date' => date('Y-m-d'),
                'note' => 'Dialysis Invoice Create',
                'paid_amount' => Str::replace(',', '', $this->cartTotal),
                'payment_received_id' => auth('admin')->id(),
            ]);

            //<----start of cash flow Transition------->
            $cashflowTransition = $serviceInvoice->cashflowTransactions()->create([
                'url'               => "Backend\Pos\PosController@show,['id' =>" . $serviceInvoice->id . "]",
                'cashflow_type'     => 'Dialysis Invoice',
                'description'       => 'Dialysis Invoice Create',
                'date'              => date('Y-m-d'),
                'ledger_id'         => AccountLedger::first()->id,
                'payment_method'    => PaymentSystem::first()->id,
            ]);

            // dd($cashflowTransition);
            // cashflowHistories
            $cashflowTransition->cashflowHistory()->create([
                'debit' => Str::replace(',', '', $this->cartTotal)
            ]);
            //<----end of cash flow Transition------->

            //<----start of dailyTransition book transaction------->
            $dailyTransition = $serviceInvoice->dailyTransactions()->create([
                'url'               =>  "Backend\Pos\PosController@show,['id' =>" . $serviceInvoice->id . "]",
                'description'       => 'Dialysis Invoice Create',
                'transaction_type'  => 'Dialysis Invoice',
                'date'              =>  date('Y-m-d'),
                'reference_no'      =>  $serviceInvoice->invoice_no,
            ]);
            // dd($dailyTransition);
            //credit transactionHistories // Dialysis Invoice increase
            $dailyTransition->transactionHistories()->create([
                'entry_name' => 'Dialysis Invoice Created',
                'credit'      => Str::replace(',', '', $this->cartTotal),
            ]);

            //debit transactionHistories // amount increase
            $dailyTransition->transactionHistories()->create([
                'entry_name' => AccountLedger::first()->name,
                'debit' => Str::replace(',', '', $this->cartTotal),
            ]);

            // LedgerTransition --->increment income
            LedgerTransition::updateOrCreate([
                'ledger_id' => AccountLedger::first()->id,
                'date'     => FinancialYearHistory::latest()->first()->start_date
            ], [
                'debit' => DB::raw('debit+' . Str::replace(',', '', $this->cartTotal))
            ]);

            $this->invoice_url = route('backend.dialysis.service.invoice',[ 'id' => $serviceInvoice->id]);
            // return redirect()->route('backend.dialysis.service.invoice',[ 'id' => $serviceInvoice->id]);
            //<----end of dailyTransition book transaction------->
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return   $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => $ex->getMessage()]);
        }
        $this->resetData();  // clear cart
        return  $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Done']);
    }


    public function serviceNameQuery()
    {
        return ServiceName::active()
            ->when($this->unit_id, function ($query) {
                $query->where('unit_id', $this->unit_id);
            })
            ->get();
    }
    public function addToCard($serviceNameId)
    {
        if (!$this->basket) {
            $serviceName  = ServiceName::find($serviceNameId);
            $this->basket = [
                $serviceNameId => [
                    "name" => $serviceName->name,
                    "qty" => 1,
                    "service_price" => $serviceName->service_price,
                    "subtotal" => $serviceName->service_price,
                ]
            ];
        } else if (isset($this->basket[$serviceNameId])) {
            $this->basket[$serviceNameId]['qty']++;
            $this->basket[$serviceNameId]['subtotal'] += $this->basket[$serviceNameId]['service_price'];
        } else {
            $serviceName  = ServiceName::find($serviceNameId);
            $this->basket[$serviceNameId] = [
                "name" => $serviceName->name,
                "qty" => 1,
                "service_price" => $serviceName->service_price,
                "subtotal" => $serviceName->service_price,
            ];
        }
        $this->cartCalculation();
    }

    public function qtyCalculation($method, $serviceNameId)
    {
        if (isset($this->basket[$serviceNameId])) {
            if ($method == "increment") {
                $this->basket[$serviceNameId]['qty']++;
                $this->basket[$serviceNameId]['subtotal'] += $this->basket[$serviceNameId]['service_price'];
            } else {
                $this->basket[$serviceNameId]['qty']--;
                $this->basket[$serviceNameId]['subtotal'] -= $this->basket[$serviceNameId]['service_price'];
            }
            $this->cartCalculation();
            return true;
        }
    }

    public function deleteServiceName($serviceNameId)
    {
        if (isset($this->basket[$serviceNameId])) {
            unset($this->basket[$serviceNameId]);
        }
        $this->cartCalculation();
        return true;
    }

    public function updateQty($value, $serviceNameId)
    {
        $this->basket[$serviceNameId]['qty']       = $value;
        $this->basket[$serviceNameId]['subtotal']  = $value * $this->basket[$serviceNameId]['service_price'];
        $this->cartCalculation();
    }

    public function cartCalculation()
    {
        $this->cartSubTotal =  array_sum(array_column($this->basket, 'subtotal'));
        $this->cartTotal    =  $this->cartSubTotal + $this->taxAmount - $this->discount_amount;
        // $this->itemCount    = count($this->basket);
        $this->serviceNameQty      = count($this->basket);
    }

    public function resetData()
    {
        $this->discount_type = $this->discount = $this->total = $this->discount_amount = $this->taxAmount = $this->taxId = $this->cartSubTotal = $this->itemCount = $this->serviceNameQty = $this->cartTotal = 0;
        $this->userDetails = null;
        $this->userId = null;
        $this->basket = array();
        return true;
    }

    public function serviceCharge()
    {

        // if(!$this->service_charge){
        //     $this->cartServiceCharge=0;
        // }
        $this->cartCalculation();
    }
}
