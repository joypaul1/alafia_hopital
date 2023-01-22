<?php

namespace App\Http\Livewire\Backend\Pos;

use App\Models\Item\Brand;
use App\Models\Item\Category;
use App\Models\Item\Item;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Helpers\InvoiceNumber;
use App\Models\OrderItem;
use App\Models\SiteInfo;
use App\Models\TableName;
use App\Models\User;
use Illuminate\Support\Facades\Route;

class Edit extends Component
{
    public $brand_id, $userId, $category_id, $userDetails,$categories, $brands, $total,$subTotal,$discount, $discountType,
    $shippingCost =0,$invoice_url=null, $taxAmount=0, $taxId, $cartSubTotal=0,$itemCount=0, $itemQty=0, $cartTotal=0,$cartServiceCharge=0;
    public $basket = array();
    public $selectedTable = array();
    public $dataTable = array();
    public $order = array();
    public $orderId = null;
    protected $listeners = ['refreshComponent' => '$refresh', 'updateQty'];

    public function mount( )
    {   $this->dataTable    = TableName::get(['id', 'name', 'booked']);
        $this->orderId      = Route::current()->parameter('order_id');
        $this->order        = Order::with('orderItems')
        ->withCount('orderItems')
        ->where('id', $this->orderId)->first();
        foreach ($this->order->orderItems()->get() as $key => $value) {
            $this->basket = [
                $value->item_id =>[
                    "name"          => Item::find($value->item_id)->name,
                    "qty"           => round($value->qty),
                    "sell_price"    => $value->unit_price,
                    "image"         => Item::find($value->item_id)->image,
                    "subtotal"      => $value->subtotal,
                ]
            ];
        }
        $this->selectedTable = $this->order->orderTables()->pluck('table_id')->toArray();
        // dd($this->selectedTable);
        $this->cartSubTotal = $this->order->sub_total;
        $this->cartServiceCharge = $this->order->service_charge;
        $this->cartTotal    = $this->order->total;
        $this->userId       = $this->order->user_id;
        $this->itemQty      = $this->order->orderItems->sum('qty');
        $this->itemCount    = $this->order->order_items_count;
        $this->userDetails  = User::where('id', $this->userId)->first()->name.'('. User::where('id', $this->userId)->first()->mobile.')';
        $this->categories   = Category::active()->select('id', 'name', 'status')->get();
        $this->brands       = Brand::active()->select('id', 'name', 'status')->get();
    }
    public function render()
    {
        return view('livewire.backend.pos.edit')->with('basket', $this->basket)->with('items', $this->itemQuery())
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

    public function editData($data)
    {
        if($this->userId == null){
            return $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'Please Select Customer']);
        }
        if (count($this->basket) == 0) {
           return  $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'Your Item Is Empty']);
        }
        try {
            DB::beginTransaction();
            //update order
            $order = Order::whereId($this->orderId)->update([
                // 'invoice_number'    => (new InvoiceNumber)->invoice_num($this->getInvoiceNumber()),
                'user_id'           => $this->userId,
                // 'date'              => date('Y-m-d'),
                'order_type'        => 'app',
                'vat'               => $this->cartSubTotal *5/100,
                'sub_total'         => $this->cartSubTotal ,
                'service_charge'    => ($this->cartSubTotal * SiteInfo::first()->service_charge)/100,
                'total'             => $this->cartTotal + ($this->cartSubTotal * SiteInfo::first()->service_charge)/100,
                'discount_amount'   => 0,
                'discount_type'     => null,
            ]);

            //order current status
            Order::whereId($this->orderId)->first()->orderStatus()->create([
                'status' => $data,
                'date'   => date('Y-m-d h:i:s'),
            ]);

            //order table unbooked
            for ($table=0; $table <count(Order::whereId($this->orderId)->first()->orderTables()->pluck('table_id')->toArray()) ; $table++) {
                $bookTable = TableName::where('id', Order::whereId($this->orderId)->first()->orderTables()->pluck('table_id')->toArray()[$table])->first();
                $bookTable->update(['booked' => 0]);
            }

            //order table booked
            for ($i=0; $i <count($this->selectedTable) ; $i++) {
                TableName::where('id', $this->selectedTable[$i])->update(['booked' => 1]);
                Order::whereId($this->orderId)->first()->orderTables()->update([
                    'table_id' => $this->selectedTable[$i],
                ]);
            }

            //remove item delete from order
            Order::whereId($this->orderId)->first()->orderItems()->whereNotIn('item_id', array_keys($this->basket))->delete();

           //update order item
            foreach ($this->basket as $itemId => $cartItem) {
                OrderItem::updateOrCreate([
                    'order_id'  => $this->orderId,
                    'item_id'   => $itemId,
                ],[
                    'qty'       => $cartItem['qty'],
                    'unit_price'=> $cartItem['sell_price'],
                    'subtotal'  => $cartItem['subtotal'],
                ]);
            }

            // $this->invoice_url = route('backend.pos-pdf.show',$order->id);
            DB::commit();

        } catch (\Exception $ex) {
            DB::rollBack();
            dd($ex->getLine());
            return   $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => $ex->getMessage(), $ex->getLine()]);
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

    public function updateQty($value,$itemId)
    {
        $this->basket[$itemId]['qty']       = $value;
        $this->basket[$itemId]['subtotal']  = $value * $this->basket[$itemId]['sell_price'] ;
        $this->cartCalculation();
    }

    public function qtyCalculation($method, $itemId)
    {
        // dd($method, $itemId);
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

    public function cartCalculation()
    {
        $this->cartSubTotal         =  array_sum(array_column($this->basket, 'subtotal')) ;
        $this->cartServiceCharge    =  ($this->cartSubTotal* SiteInfo::first()->service_charge)/100 ;
        $this->cartTotal            =  $this->cartSubTotal + $this->cartServiceCharge;
        $this->itemCount            =  count($this->basket);
        $this->itemQty              =  array_sum(array_column($this->basket, 'qty'));
    }

    public function resetData()
    {
        $this->discountType = $this->discount = $this->total=$this->shippingCost=$this->taxAmount= $this->taxId = $this->cartSubTotal=$this->itemCount=$this->itemQty=$this->cartTotal=$this->cartServiceCharge= 0;
        $this->userDetails= null;
        $this->userId= null;
        $this->basket = array();
        return true;
    }

}
