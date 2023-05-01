<?php

namespace App\Models\Prescription;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;


class PrescriptionOtherSpecification extends Model
{
    use AutoTimeStamp, GlobalScope;
    protected $guarded = ['id'];
}
