<?php

namespace App\Models\Radiology;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RadiologyServiceName extends Model
{
    use AutoTimeStamp, GlobalScope, SoftDeletes;
    protected $guarded = ['id'];
}
