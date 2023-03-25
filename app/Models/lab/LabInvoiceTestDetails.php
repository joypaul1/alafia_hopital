<?php

namespace App\Models\lab;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;

class LabInvoiceTestDetails extends Model
{
    use GlobalScope, AutoTimeStamp;

    protected $guarded =['id'];

    public function testName()
    {
        return $this->belongsTo(LabTest::class, 'lab_test_id', 'id');
    }
}
