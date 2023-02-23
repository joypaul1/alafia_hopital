<?php

namespace App\Models\Appointment;

use App\Models\DailyAccountTransaction;
use App\Models\Doctor\Doctor;
use App\Models\Doctor\DoctorAppointmentSchedule;
use App\Models\Patient\Patient;
use App\Models\Transaction\CashFlow;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AuthScopes;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Appointment extends Model
{
    use AuthScopes,AutoTimeStamp,GlobalScope;
    protected $guarded =['id'];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }

    public function schedule()
    {
        return $this->hasOne(DoctorAppointmentSchedule::class, 'doctor_appointment_schedule_id', 'id');
    }


    /**
        * Get all of the paymentHistories for the appointment
        *
        * @return \Illuminate\Database\Eloquent\Relations\HasMany
        */
        public function paymentHistories(): HasMany
        {
            return $this->hasMany(AppointmentPaymentHistory::class, 'appointment_id', 'id');
        }


    /**
     * Get all of the Purchase's daybook transaction.
     */
    public function dailyTransactions()
    {
        return $this->morphMany(DailyAccountTransaction::class, 'transactionable');
    }
    /**
     * Get all of the Purchase's cash flow transaction.
     */
    public function cashflowTransactions()
    {
        return $this->morphMany(CashFlow::class, 'cashflowable');
    }
}
