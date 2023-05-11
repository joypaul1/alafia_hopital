<?php

namespace App\Models\Radiology;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;

class RadiologyServiceInvoicePaymentHistory extends Model
{
    use GlobalScope, AutoTimeStamp;
    protected $guarded = ['id'];
}
