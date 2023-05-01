<?php

namespace App\Models\Purchase;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PurchaseShipmentHistory extends Model
{
    use AutoTimeStamp,GlobalScope;
    protected $guarded =['id'];
}
