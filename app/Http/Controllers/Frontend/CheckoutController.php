<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\Order\OrderShipment;
use App\Models\OrderItem;
use App\Models\OrderPaymentHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function order(Request $request)
    {
        $cart = Cart::whereAuthUser()->first();
        $cartItems = CartItem::where('cart_id', $cart->id)->get();
        try {
            DB::beginTransaction();
            $order = Order::create([
                'user_id'       => auth()->id(),
                'date'          => date('Y-m-d'),
                'order_type'    => 'web',
                'sub_total'     => $cart->sub_total,
                'total'         => $cart->total,
            ]);
            foreach ($cartItems as $key => $cartItem) {
                OrderItem::create([
                    'order_id' =>$order->id,
                    'item_id'   => $cartItem->item_id,
                    'qty'       => $cartItem->qty,
                    'unit_price'=> $cartItem->unit_price,
                    'subtotal'  => $cartItem->subtotal,
                ]);
                $cartItem->delete();

            }
            OrderPaymentHistory::create([
                'order_id'  => $order->id,
                'type'      => 'cash_on_delivery',
                'date'      =>  date('Y-m-d'),
            ]);
            OrderShipment::create([
                'order_id'  => $order->id,
                'mobile'  => $request->mobile,
                'email'  => $request->email,
                'city'  => $request->city,
                'state'  => $request->state,
                'postal_code'  => $request->postal_code,
                'address_line_1'  => $request->address_line_1,
                'billing_address_2'  => $request->billing_address_2,
            ]);
            $cart->delete();
            session()->forget('cart');
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        return redirect()->to('/');
    }
}
