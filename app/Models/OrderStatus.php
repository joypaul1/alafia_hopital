<?php

namespace App\Models;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use AutoTimeStamp, GlobalScope;

    protected $guarded = ['id'];
}
