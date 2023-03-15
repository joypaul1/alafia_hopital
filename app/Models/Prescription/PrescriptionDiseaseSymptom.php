<?php

namespace App\Models\Prescription;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;


class PrescriptionDiseaseSymptom extends Model
{
    protected $table = 'prescription_diseases_symptoms'; // prescription_desease_symptoms //prescription_diseases_symptoms

    // diseases
    use AutoTimeStamp, GlobalScope;
    protected $guarded = ['id'];
}
