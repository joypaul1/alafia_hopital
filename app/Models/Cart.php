<?php

namespace App\Models;

use App\Traits\AuthScopes;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use AutoTimeStamp,GlobalScope,AuthScopes;

    protected $guarded = ['id'];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'cart_id');
    }

}
