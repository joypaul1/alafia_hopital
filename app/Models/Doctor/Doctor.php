<?php

namespace App\Models\Doctor;

use App\Traits\AuthScopes;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Doctor extends Model
{
   use AuthScopes,AutoTimeStamp,GlobalScope;
   protected $guarded =['id'];

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
}
