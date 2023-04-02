<?php

namespace App\Http\Livewire\Backend\Pos;


use App\Models\Item\Item;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Helpers\InvoiceNumber;
use App\Models\Account\AccountLedger;
use App\Models\Item\Unit;
use App\Models\LedgerTransition;
use App\Models\Service\ServiceName;
use App\Models\SiteInfo;
use App\Models\TableName;

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
        return view(
            'livewire.backend.pos.create'
        )->with('basket', $this->basket)
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
        if (!Order::latest()->first()) {
            return 1;
        } else {
            return Order::latest()->first()->invoice_number + 1;
        }
    }

    public function storeData($data)
    {
        if ($this->userId == null) {
            return $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'Please Select Customer']);
        }
        if (count($this->basket) == 0) {
            return  $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'Your Service Is Empty']);
        }
        try {
            DB::beginTransaction();
            //create order
            $order = Order::create([
                'invoice_number'    => (new InvoiceNumber)->invoice_num($this->getInvoiceNumber()),
                'user_id'           => $this->userId,
                'date'              => date('Y-m-d'),
                'order_type'        => 'app',
                'vat'               => $this->taxAmount,
                'sub_total'         => $this->cartSubTotal,
                'total'             => $this->cartTotal,
                'discount'          => $this->discount,
                'discount_amount'   => $this->discount_amount,
                'discount_type'     => $this->discount_type ,
            ]);
            // dd( $order);

            //order current status
            $v= $order->orderStatus()->create([
                'status' => $data,
                'date' => date('Y-m-d h:i:s'),
            ]);
            //order items
            foreach ($this->basket as $itemId => $cartItem) {
                $orderItem = $order->orderItems()->create([
                    'order_id'  => $order->id,
                    'item_id'   => $cartItem['item_id'],
                    'qty'       => $cartItem['qty'],
                    'unit_price'=> $cartItem['sell_price'],
                    'subtotal'  => $cartItem['subtotal'],
                ]);
                // dd( $orderItem);

            }

            //  OrderPaymentHistory
            if ($paymentMethod == 'cash_on_delivery') {
                $orderPaymentHistory= OrderPaymentHistory::create([
                    'order_id'  => $order->id,
                    'type'      => 'cash_on_delivery',
                    'date'      =>  date('Y-m-d'),
                ]);

            }else{
                $orderPaymentHistory= OrderPaymentHistory::create([
                    'order_id'  => $order->id,
                    'type'      => 'online_payment',
                    'date'      =>  date('Y-m-d'),
                ]);
                $order->paymentHistories()->create([
                    'ledger_id' =>13,//13
                    'payment_method'=> 'cash' ,
                    'payment_system_id' =>6 ,//6
                    'date' =>date('Y-m-d'),
                    'note' =>'Sell Online',
                    'paid_amount' =>Str::replace(',', '', $this->cartTotal),
                    'payment_received_id' => auth('admin')->id(),
                ]);

             //<----start of cash flow Transition------->
            $cashflowTransition= $order->cashflowTransactions()->create([
                'url'               => "Backend\Pos\PosController@show,['id' =>".$order->id."]",
                'cashflow_type'     => 'Sell',
                'description'       => 'Sell Food',
                'date'              => date('Y-m-d'),
                'ledger_id'         =>13,
                'payment_method'    => 6,
            ]);
            // dd($cashflowTransition);
            // cashflowHistories
            $cashflowTransition->cashflowHistory()->create([
                'debit' => Str::replace(',', '', $this->cartTotal)
            ]);
            //<----end of cash flow Transition------->

            //<----start of dailyTransition book transaction------->
            $dailyTransition = $order->dailyTransactions()->create([
                'url'               =>  "Backend\Pos\PosController@show,['id' =>".$order->id."]",
                'description'       => 'Sell Food',
                'transaction_type'  => 'Sell',
                'date'              =>  date('Y-m-d'),
                'reference_no'      =>  $order->invoice_number,
            ]);
            // dd($dailyTransition);
            //credit transactionHistories // sell increase
            $dailyTransition->transactionHistories()->create([
                'entry_name' => 'Sell Food',
                'credit'      => Str::replace(',', '', $this->cartTotal),
            ]);

            //debit transactionHistories // amount increase
            $dailyTransition->transactionHistories()->create([
                'entry_name' => AccountLedger::find(13)->name,
                'debit' => Str::replace(',', '', $this->cartTotal),
            ]);

            // LedgerTransition --->increment costing
            $LedgerTransition=LedgerTransition::updateOrCreate([
                'ledger_id'=> 13,
                'date'     => FinancialYearHistory::latest()->first()->start_date
            ],[
                'debit' => DB::raw('debit+'. Str::replace(',', '', $this->cartTotal))
            ]);
            // dd($LedgerTransition);

            }
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
