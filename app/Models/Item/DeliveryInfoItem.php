<?php

namespace App\Models\Item;

use App\Traits\GlobalScope;
use App\Traits\AutoTimeStamp;
use Illuminate\Database\Eloquent\Model;

class DeliveryInfoItem extends Model
{
    use GlobalScope, AutoTimeStamp;
    
    protected $guarded =['id'];
}
