<?php

namespace App\Http\Controllers\Frontend\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Item\Item;
use App\Traits\CalculateCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    use CalculateCart;

    public function addCart(Request $request)
    {

        try {
            DB::beginTransaction();
            $cart = Cart::whereAuthUser()->first();
            $item = Item::whereId($request->item_id)->first();
            $itemQty =$request->qty??1;

            if (!$cart)
            $cart = Cart::create(['user_id' => auth('web')->id(), 'date' => date('Y-m-d'), 'cart_status' => 'web']);
            $cartItem = CartItem::where('cart_id', $cart->id)->where('item_id', $item->id)->first();
            // dd($item->sell_price);
            if ($cartItem) {
                $cartItem->qty = $itemQty;
                $cartItem->save();
            }else {
                $cartItem = CartItem::create([
                    'cart_id'   => $cart->id,
                    'item_id'   => $item->id,
                    // 'unit_price'=> number_format($item->sell_price , 2),
                    'unit_price'=>$item->sell_price,
                    'qty'       =>    $itemQty,
                    'subtotal'  => $itemQty * $item->sell_price ,
                ]);

            }
            // dd($cartItem );
            session(['cart' => $this->calculateCart(true)]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        return back();

    }

    public function deleteCart(Request $request)
    {
        try {
            DB::beginTransaction();
            $cart = Cart::whereAuthUser()->first();
            $item = Item::whereId($request->item_id)->first();
            $cartItem = CartItem::where('cart_id', $cart->id)->where('item_id', $item->id)->first();
            if ($cartItem) {
                $cartItem->delete();
            }
            session(['cart' => $this->calculateCart(true)]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        return back();
    }
}
