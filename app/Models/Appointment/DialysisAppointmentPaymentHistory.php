<?php

namespace App\Models\Appointment;

use App\Traits\AuthScopes;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;

class DialysisAppointmentPaymentHistory extends Model
{
    use AuthScopes,AutoTimeStamp,GlobalScope;
    protected $guarded =['id'];

    public function appointment()
    {
        return $this->belongsTo(DialysisAppointment::class, 'appointment_id', 'id');
    }

    public function paymentSystem()
    {
        return $this->belongsTo(PaymentSystem::class, 'payment_system_id', 'id');
    }
}
