<?php

namespace App\Models\Prescription;
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
     * Get all of the medicine for the Prescription
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function medicine(): HasMany
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


    public function otherSpecifications()
    {
        // prescription_other_specifications
        return $this->hasMany(PrescriptionOtherSpecification::class, 'prescription_id', 'id');
    }
}
