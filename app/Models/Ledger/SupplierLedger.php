<?php

namespace App\Models\Ledger;

use App\Traits\AutoTimeStamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierLedger extends Model
{
    use AutoTimeStamp;
    protected $guarded = ['id'];
}
