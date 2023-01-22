<?php

namespace App\Models\Bed;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bed extends Model
{
    use GlobalScope, AutoTimeStamp,SoftDeletes;

    protected $guarded =['id'];
}
