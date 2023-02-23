<?php

namespace App\Models\Appointment;

use App\Models\Doctor\DoctorAppointmentSchedule;
use App\Models\Patient\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AuthScopes;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;

class Appointment extends Model
{
    use AuthScopes,AutoTimeStamp,GlobalScope;
    protected $guarded =['id'];

    public function patient()
    {
        return $this->hasOne(Patient::class, 'patient_id', 'id');
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class, 'doctor_id', 'id');
    }

    public function schedule()
    {
        return $this->hasOne(DoctorAppointmentSchedule::class, 'doctor_appointment_schedule_id', 'id');
    }


}
