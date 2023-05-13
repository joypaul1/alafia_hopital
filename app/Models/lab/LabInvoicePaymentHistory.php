<?php

namespace App\Models\lab;

use App\Models\PaymentSystem;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;

class LabInvoicePaymentHistory extends Model
{
    use GlobalScope, AutoTimeStamp;

    protected $guarded =['id'];

    public function paymentMethodName()
    {
        return $this->belongsTo(PaymentSystem::class, 'payment_method');
    }
}
