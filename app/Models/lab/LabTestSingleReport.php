<?php

namespace App\Models\lab;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabTestSingleReport extends Model
{
    use GlobalScope, AutoTimeStamp;

    protected $guarded =['id'];
}
