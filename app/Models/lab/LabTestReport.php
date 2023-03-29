<?php

namespace App\Models\lab;

use App\Models\Patient\Patient;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;

class LabTestReport extends Model
{
    use GlobalScope, AutoTimeStamp;

    protected $guarded =['id'];

    public function details()
    {
        return $this->hasMany(LabTestReportDetails::class, 'lab_test_report_id', 'id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }


}
