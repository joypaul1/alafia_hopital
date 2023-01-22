<?php
namespace App\Traits;

use App\Models\Cart;

trait CalculateCart
{

    private function calculateCart($dbHit = true, $cart = null, $cartItems = null, $coupon = null, $user_id = null)
    {
        if ($cart == null && $dbHit) {
            $cart = Cart::whereUserId($user_id ??auth()->id())
                ->with(['cartItems' => function ($q) {
                    $q->with(['item' => function ($item) {
                        $item->active();
                    }]);
                }])
                ->first();
        }
        if ($cart) {
            $cartItems = $cart->cartItems;
            $cart->cart_status = 'cart';
            $cart->cart_type = 'web_cart';
            $cart->cart_qty = $cartItems->sum('qty');
            $cart->sub_total = $cartItems->sum('subtotal');
            $cart->total = $cartItems->sum('subtotal');
            $cart->save();
            // dd( $cart);
            // dd($cartSubtotal);
            // $cart->cartItems->map(function ($cartItem) {
            //     return $this->calculateCartItem($cartItem);
            // });
            // $activeItems = collect($cart->cart_items->where('active', true));

            // $cart->activeCount = $activeItems->count();

            // $cart->subtotal_without_coupon = $activeItems->sum('subtotal');

            // if ($dbHit) {
            //     $cart->cart_items->load('user');
            // }

            // $cart->cart_items = collect($cart->cart_items);
        }
        return $cart;
        // ->load('cartItems');
    }

    private function calculateCartItem($cartItem)
    {

        if ($cartItem->active) {
            // $variant                        = collect($cartItem->product->variants)->where('id', $cartItem->variant_id)->first();
            // if($cartItem->product->flash_sale){

            //     $cartItem->sale_percentage      = $cartItem->product->flash_sale->percentage;
            //     $cartItem->original_price       = $cartItem->product->getOriginalPriceAttribute($variant);
            //     $cartItem->sale_price           = $cartItem->original_price  - ($cartItem->original_price * $cartItem->sale_percentage)/100;
            // }else{
            //     $cartItem->sale_percentage      = $cartItem->product->getSalePercentageAttribute($variant);
            //     $cartItem->sale_price           = $cartItem->product->getSalePriceAttribute($variant);
            //     $cartItem->original_price       = $cartItem->product->getOriginalPriceAttribute($variant);
            // }

            $cartItem->sale_subtotal        = round($cartItem->sale_price * $cartItem->qty);
            // $cartItem->original_subtotal    = round($cartItem->original_price * $cartItem->qty);
            // $cartItem->subtotal             = $cartItem->sale_percentage > 0 ? $cartItem->sale_subtotal : $cartItem->original_subtotal;
            // $cartItem->commission           = $cartItem->subtotal * ($cartItem->product->sub_category->commission / 100);
            // $cartItem->vat                  = $cartItem->commission * ($cartItem->product->sub_category->vat / 100);
            // $cartItem->user_id              = $cartItem->product->user_id;
            // $cartItem->variant              = $variant;
        }
        return $cartItem;
    }
}
