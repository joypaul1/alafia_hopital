<?php

namespace App\Models\Service;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceType extends Model
{
    use AutoTimeStamp, GlobalScope, SoftDeletes;

    protected $guarded = ['id'];
}
