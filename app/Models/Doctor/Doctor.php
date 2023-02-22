<?php

namespace App\Models\Doctor;

use App\Traits\AuthScopes;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
   use AuthScopes,AutoTimeStamp,GlobalScope;
   protected $guarded =['id'];
}
