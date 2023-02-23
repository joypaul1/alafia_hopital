<?php

namespace App\Models\Appointment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AuthScopes;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;

class AppointmentPaymentHistory extends Model
{
    use AuthScopes,AutoTimeStamp,GlobalScope;
    protected $guarded =['id'];
    
}
