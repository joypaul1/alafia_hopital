<?php

namespace App\Models\lab;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;

class LabInvoiceTestTubeDetails extends Model
{
    use GlobalScope, AutoTimeStamp;

    protected $guarded =['id'];

    public function tubeName()
    {
        return $this->belongsTo(LabTestTube::class, 'lab_test_tube_id', 'id');
    }
}
