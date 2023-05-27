<?php

namespace App\Models\Prescription;

use App\Models\Appointment\Appointment;
use App\Models\Doctor\Doctor;
use App\Models\Patient\Patient;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Prescription extends Model
{
    use AutoTimeStamp, GlobalScope;
    protected $guarded = ['id'];

    /**
     * Get all of the medicines for the Prescription
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function medicines(): HasMany
    {
        return $this->hasMany(PrescriptionMedicine::class, 'prescription_id', 'id');
    }

    /**
     * Get all of the comments for the Prescription
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function diseasesSymptoms(): HasMany
    {
        return $this->hasMany(PrescriptionDiseaseSymptom::class, 'prescription_id', 'id');
    }

    // prescription_other_specifications
    public function otherSpecifications()
    {
        return $this->hasMany(PrescriptionOtherSpecification::class, 'prescription_id', 'id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id', 'id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }

    /**
     * Get all of the labTest for the Prescription
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function labTest(): HasMany
    {
        return $this->hasMany(PrescriptionTest::class, 'prescription_id', 'id');
    }
}
