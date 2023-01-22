<?php

namespace App\Models\Bed;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;

class BedType extends Model
{
    use GlobalScope, AutoTimeStamp;

    protected $guarded =['id'];

}
