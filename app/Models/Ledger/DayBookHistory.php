<?php

namespace App\Models\Ledger;

use App\Traits\AutoTimeStamp;
use Illuminate\Database\Eloquent\Model;

class DayBookHistory extends Model
{
    use AutoTimeStamp;
    protected $guarded = ['id'];
}
