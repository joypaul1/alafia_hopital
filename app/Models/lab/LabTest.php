<?php

namespace App\Models\lab;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LabTest extends Model
{
    use GlobalScope, AutoTimeStamp;

    protected $guarded =['id'];

    /**
     * Get the tube that owns the LabTest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tube(): BelongsTo
    {
        return $this->belongsTo(LabTestTube::class, 'lab_test_tube_id', 'id');
    }

    public function labInvoiceTest()
    {
        return $this->hasMany(LabInvoiceTestDetails::class, 'lab_test_id');
    }

}
