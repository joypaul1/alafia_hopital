<?php

namespace App\Models\Doctor;

use App\Models\Appointment\Appointment;
use App\Models\Employee\Department;
use App\Models\Employee\Designation;
use App\Traits\AuthScopes;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use AuthScopes, AutoTimeStamp, GlobalScope, SoftDeletes;
    protected $guarded = ['id'];

    /**
     * Get all of the comments for the Doctor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function doctorAppointmentSchedules(): HasMany
    {
        return $this->hasMany(DoctorAppointmentSchedule::class, 'doctor_id', 'id');
    }

    /**
     * Get all of the consultations for the Doctor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function consultations(): HasMany
    {
        return $this->hasMany(DoctorConsultation::class, 'doctor_id', 'id');
    }

    /**
     * Get all of the doctorVisitingSchedules for the Doctor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function doctorVisitingSchedules(): HasMany
    {
        return $this->hasMany(DoctorVisitSchedule::class, 'doctor_id', 'id');
    }


    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id', 'id');
    }

    public function ledger()
    {
        return $this->hasOne(DoctorLedger::class, 'doctor_id', 'id');
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class, 'doctor_id', 'id');
    }

    public function withdraw()
    {
        return $this->hasMany(DoctorWithDrawHistory::class, 'doctor_id', 'id');
    }
}
