<?php

namespace App\Models\Transaction;

use App\Traits\AutoTimeStamp;
use Illuminate\Database\Eloquent\Model;

class CashFlowHistory extends Model
{
    use AutoTimeStamp;
    protected $guarded = ['id'];
}
