<?php

namespace App\Models;

use App\Traits\AutoTimeStamp;

use Illuminate\Database\Eloquent\Model;

class InvoicePrefix extends Model
{
    use AutoTimeStamp;
    protected $guarded = ['id'];
}
