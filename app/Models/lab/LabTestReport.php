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

    public function testName()
    {
        return $this->belongsTo(LabTest::class, 'lab_test_id', 'id');
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }

    public function labInvoiceTestDetails()
    {
        return $this->belongsTo(LabInvoiceTestDetails::class, 'lab_invoice_test_detail_id', 'id');
    }

}
