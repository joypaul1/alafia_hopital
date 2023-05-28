<?php

namespace App\Models\Appointment;

use App\Models\DailyAccountTransaction;
use App\Models\Doctor\Doctor;
use App\Models\Doctor\DoctorAppointmentSchedule;
use App\Models\Patient\Patient;
use App\Models\Prescription\Prescription;
use App\Models\Transaction\CashFlow;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AuthScopes;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Appointment extends Model
{
    use AuthScopes, AutoTimeStamp, GlobalScope;
    protected $guarded = ['id'];


    // this is a recommended way to declare event handlers
    public static function boot()
    {
        parent::boot();
        self::deleting(function ($appointment) { // before delete() method call this
            // $appointment->schedule()->delete();
            $appointment->paymentHistories()->each(function ($paymentHistory) {
                $paymentHistory->delete(); // <-- direct deletion
            });
            $appointment->dailyTransactions()->each(function ($dailyTransaction) {
                $dailyTransaction->delete(); // <-- direct deletion
            });
            $appointment->cashflowTransactions()->each(function ($cashflowTransaction) {
                $cashflowTransaction->delete(); // <-- direct deletion
            });
        });
    }

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


    /**
     * Get the prescription associated with the Appointment
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function prescription(): HasOne
    {
        return $this->hasOne(Prescription::class, 'appointment_id', 'id');
    }
}
