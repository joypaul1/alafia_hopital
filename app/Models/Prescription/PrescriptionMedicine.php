<?php

namespace App\Models\Prescription;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


class PrescriptionMedicine extends Model
{
    use AutoTimeStamp, GlobalScope;
    protected $guarded = ['id'];
}
