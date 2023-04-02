<?php

namespace App\Http\Livewire\Backend\Pos;


use App\Models\Item\Item;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Helpers\InvoiceNumber;
use App\Models\Item\Unit;
use App\Models\Service\ServiceName;
use App\Models\SiteInfo;
use App\Models\TableName;

class Create extends Component
{
    public $brand_id, $userId, $unit_id, $userDetails,$serviceNames, $units, $total,$subTotal,$discount, $discountType,
    $shippingCost =0,$invoice_url=null, $taxAmount=0, $taxId, $cartSubTotal=0,$itemCount=0, $itemQty=0, $cartTotal=0;
    public $basket = array();
    public $dataTable = array();
    protected $listeners = ['refreshComponent' => '$refresh', 'updateQty'];

    public function mount( )
    {
        $this->units   = Unit::active()->select('id', 'name')->get();
        $this->serviceNames = $this->serviceNameQuery();
    }
    public function render()
    {
        // dd($this->serviceNameQuery());
        return view('livewire.backend.pos.create'
        )->with('basket', $this->basket)
        // ->with('serviceNames', $this->serviceNameQuery())
        ->extends('backend.layout.posApp')->section('content');
    }


    public function getInvoiceNumber()
    {
        if (!Order::latest()->first()) {
           return 1;
        }else{
            return Order::latest()->first()->invoice_number+1;
        }
    }

    public function storeData($data)
    {
        if($this->userId == null){
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
                'vat'               => $this->cartSubTotal * 1..SiteInfo::first()->vat,
                'sub_total'         => $this->cartSubTotal,
                'total'             => $this->cartTotal,
                'discount_amount'   => 0,
                'discount_type'     => null,
            ]);

            //order current status
            $order->orderStatus()->create([
                'status' => $data,
                'date' => date('Y-m-d h:i:s'),
            ]);



            //order serviceNames
            foreach ($this->basket as $serviceNameId => $cartItem) {
                $order->orderserviceNames()->create([
                    'order_id'  => $order->id,
                    'item_id'   => $serviceNameId,
                    'qty'       => $cartItem['qty'],
                    'unit_price'=> $cartItem['service_price'],
                    'subtotal'  => $cartItem['subtotal'],
                ]);
            }


            // $this->invoice_url = route('backend.pos-pdf.show',$order->id);
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
        ->when($this->unit_id, function($query){
            $query->where('unit_id', $this->unit_id);
        })
        ->get();

    }
    public function addToCard($serviceNameId)
    {
        if(!$this->basket){
            $serviceName  = ServiceName::find($serviceNameId);
            $this->basket = [
                $serviceNameId =>[
                    "name" => $serviceName->name,
                    "qty" => 1,
                    "service_price" => $serviceName->service_price,
                    "subtotal" => $serviceName->service_price,
                ]
            ];
        }else if(isset($this->basket[$serviceNameId])){
            $this->basket[$serviceNameId]['qty']++;
            $this->basket[$serviceNameId]['subtotal'] += $this->basket[$serviceNameId]['service_price'] ;
        }
        else{
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
        if(isset($this->basket[$serviceNameId])){
            if($method == "increment"){
                $this->basket[$serviceNameId]['qty']++;
                $this->basket[$serviceNameId]['subtotal'] += $this->basket[$serviceNameId]['service_price'] ;
            }else{
                $this->basket[$serviceNameId]['qty']--;
                $this->basket[$serviceNameId]['subtotal'] -= $this->basket[$serviceNameId]['service_price'] ;
            }
            $this->cartCalculation();
            return true;
        }
    }

    public function deleteServiceName($serviceNameId)
    {
        if(isset($this->basket[$serviceNameId])){
           unset($this->basket[$serviceNameId]);
        }
        $this->cartCalculation();
        return true;
    }

    public function updateQty($value,$serviceNameId)
    {
        $this->basket[$serviceNameId]['qty']       = $value;
        $this->basket[$serviceNameId]['subtotal']  = $value * $this->basket[$serviceNameId]['service_price'] ;
        $this->cartCalculation();
    }

    public function cartCalculation()
    {
        $this->cartSubTotal =  array_sum(array_column($this->basket, 'subtotal')) ;
        $this->cartTotal =  $this->cartSubTotal;
        $this->itemCount=count($this->basket);
        $this->itemQty=count($this->basket);
    }

    public function resetData()
    {
        $this->discountType = $this->discount = $this->total=$this->shippingCost=$this->taxAmount= $this->taxId = $this->cartSubTotal=$this->itemCount=$this->itemQty=$this->cartTotal=0;
        // $this->cartServiceCharge= 0;
        $this->userDetails= null;
        $this->userId= null;
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
