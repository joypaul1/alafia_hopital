<?php

namespace App\Models\Doctor;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;

class DoctorWithDrawHistory extends Model
{
    use AutoTimeStamp, GlobalScope;
    protected $guarded = ['id'];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }
}
