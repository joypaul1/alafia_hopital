<?php

namespace App\Http\Livewire\Backend\Pos;

use App\Models\Item\Brand;
use App\Models\Item\Category;
use App\Models\Item\Item;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Helpers\InvoiceNumber;
use App\Models\SiteInfo;
use App\Models\TableName;

class Create extends Component
{
    public $brand_id, $userId, $category_id, $userDetails,$categories, $brands, $total,$subTotal,$discount, $discountType,
    $shippingCost =0,$invoice_url=null, $taxAmount=0, $taxId, $cartSubTotal=0,$itemCount=0, $itemQty=0, $cartTotal=0,$cartServiceCharge=0;
    public $basket = array();
    public $service_charge = true;
    public $selectedTable = array();
    public $dataTable = array();
    protected $listeners = ['refreshComponent' => '$refresh', 'updateQty'];

    public function mount( )
    {   $this->dataTable    = TableName::get(['id', 'name', 'booked']);
        $this->userId       = 2;
        $this->categories   = Category::active()->select('id', 'name', 'status')->get();
        $this->brands       = Brand::active()->select('id', 'name', 'status')->get();
    }
    public function render()
    {
        return view('livewire.backend.pos.create')->with('basket', $this->basket)->with('items', $this->itemQuery())
        ->extends('backend.layout.posApp')
        ->section('content');
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
           return  $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'Your Item Is Empty']);
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
                'service_charge'    => $this->cartServiceCharge,
                'total'             => $this->cartTotal,
                'discount_amount'   => 0,
                'discount_type'     => null,
            ]);

            //order current status
            $order->orderStatus()->create([
                'status' => $data,
                'date' => date('Y-m-d h:i:s'),
            ]);

            //order table booked
            for ($i=0; $i <count($this->selectedTable) ; $i++) {
                $order->orderTables()->create([
                    'table_id' => $this->selectedTable[$i],
                ]);
                TableName::where('id', $this->selectedTable[$i])->update(['booked' => 1]);
            }

            //order items
            foreach ($this->basket as $itemId => $cartItem) {
                $order->orderItems()->create([
                    'order_id'  => $order->id,
                    'item_id'   => $itemId,
                    'qty'       => $cartItem['qty'],
                    'unit_price'=> $cartItem['sell_price'],
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


    public function itemQuery()
    {
        return Item::active()
        ->when($this->brand_id, function($query){
            $query->where('brand_id', $this->brand_id);
        })
        ->when($this->category_id, function($query){
            $query->where('category_id', $this->category_id);
        })
        ->paginate(25);

    }
    public function addToCard($itemId)
    {
        if(!$this->basket){
            $item  = Item::find($itemId);
            $this->basket = [
                $itemId =>[
                    "name" => $item->name,
                    "qty" => 1,
                    "sell_price" => $item->sell_price,
                    "image" => $item->image,
                    "subtotal" => $item->sell_price,
                ]
            ];
        }else if(isset($this->basket[$itemId])){
            $this->basket[$itemId]['qty']++;
            $this->basket[$itemId]['subtotal'] += $this->basket[$itemId]['sell_price'] ;
        }
        else{
            $item  = Item::find($itemId);
            $this->basket[$itemId] = [
                "name" => $item->name,
                "qty" => 1,
                "sell_price" => $item->sell_price,
                "image" => $item->image,
                "subtotal" => $item->sell_price,
            ];
        }
        $this->cartCalculation();
    }

    public function qtyCalculation($method, $itemId)
    {
        if(isset($this->basket[$itemId])){
            if($method == "increment"){
                $this->basket[$itemId]['qty']++;
                $this->basket[$itemId]['subtotal'] += $this->basket[$itemId]['sell_price'] ;
            }else{
                $this->basket[$itemId]['qty']--;
                $this->basket[$itemId]['subtotal'] -= $this->basket[$itemId]['sell_price'] ;
            }
            $this->cartCalculation();
            return true;
        }
    }

    public function deleteItem($itemId)
    {
        if(isset($this->basket[$itemId])){
           unset($this->basket[$itemId]);
        }
        $this->cartCalculation();
        return true;
    }

    public function updateQty($value,$itemId)
    {
        $this->basket[$itemId]['qty']       = $value;
        $this->basket[$itemId]['subtotal']  = $value * $this->basket[$itemId]['sell_price'] ;
        $this->cartCalculation();
    }

    public function cartCalculation()
    {
        $this->cartSubTotal =  array_sum(array_column($this->basket, 'subtotal')) ;
        $this->cartServiceCharge = 0;
        if($this->service_charge === true){
            $this->cartServiceCharge =  ($this->cartSubTotal* SiteInfo::first()->service_charge)/100;
        }

        $this->cartTotal =  $this->cartSubTotal + $this->cartServiceCharge;
        $this->itemCount=count($this->basket);
        $this->itemQty=count($this->basket);
    }

    public function resetData()
    {
        $this->discountType = $this->discount = $this->total=$this->shippingCost=$this->taxAmount= $this->taxId = $this->cartSubTotal=$this->itemCount=$this->itemQty=$this->cartTotal=$this->cartServiceCharge= 0;
        $this->userDetails= null;
        $this->userId= null;
        $this->basket = array();
        return true;
    }

    public function serviceCharge()
    {
        // $this->cartServiceCharge=0
        // dd($this->service_charge);
        if(!$this->service_charge){
            $this->cartServiceCharge=0;
            // dd($this->service_charge);
            // $this->service_charge === false??
        }
        $this->cartCalculation();
    }

}
