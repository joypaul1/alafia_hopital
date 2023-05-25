<?php

namespace App\Models\Prescription;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


class PrescriptionTest extends Model
{
    use AutoTimeStamp, GlobalScope;
    protected $guarded = ['id'];


    public function prescription()
    {
        return $this->belongsTo(Prescription::class, 'prescription_id', 'id');
    }
}
