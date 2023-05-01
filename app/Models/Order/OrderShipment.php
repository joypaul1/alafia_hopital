<?php

namespace App\Models\Order;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;

class OrderShipment extends Model
{
    use AutoTimeStamp, GlobalScope;

    protected $guarded = ['id'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
