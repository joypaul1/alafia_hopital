<?php

namespace App\Models\Transaction;

use App\Models\Account\AccountLedger;
use App\Models\PaymentSystem;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Symfony\Component\HttpFoundation\AcceptHeader;

class CashFlow extends Model
{
    use AutoTimeStamp, GlobalScope,SoftDeletes;
    protected $guarded = ['id'];

     /**
     * Get the parent transition model
     */
    public function cashflowable()
    {
        return $this->morphTo(__FUNCTION__, 'cashflowable_type', 'cashflowable_id');
    }

    public function cashflowHistory()
    {
        return $this->hasOne(CashFlowHistory::class, 'cash_flow_id', 'id');
    }

    public function ledger()
    {
        return $this->belongsTo(AccountLedger::class, 'ledger_id');
    }

    public function method()
    {
        return $this->belongsTo(PaymentSystem::class, 'payment_method');
    }
}
