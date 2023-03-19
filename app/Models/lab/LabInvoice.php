<?php

namespace App\Models\lab;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;

class LabInvoice extends Model
{
    use GlobalScope, AutoTimeStamp;

    protected $guarded =['id'];
}
