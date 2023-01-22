<?php

namespace App\Models;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use GlobalScope, AutoTimeStamp;

    protected $guarded =['id'];
}
