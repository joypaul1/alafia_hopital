<?php

namespace App\Models\Doctor;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorAppointmentSchedule extends Model
{
    use AutoTimeStamp, GlobalScope;
    protected $guarded =['id'];
}
