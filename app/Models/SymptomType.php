<?php

namespace App\Models;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SymptomType extends Model
{
    use AutoTimeStamp, GlobalScope,SoftDeletes;

    protected $guarded = ['id'];
}
