<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
class CommissionHistory extends Model
{
    use AutoTimeStamp,GlobalScope;

    protected $guarded = ['id'];
}
