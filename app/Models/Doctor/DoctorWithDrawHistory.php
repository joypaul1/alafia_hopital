<?php

namespace App\Models\Doctor;

use App\Models\Account\AccountLedger;
use App\Models\DailyAccountTransaction;
use App\Models\PaymentSystem;
use App\Models\Transaction\CashFlow;
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

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentSystem::class, 'payment_method_id');
    }
    public function paymentLedger()
    {
        return $this->belongsTo(AccountLedger::class, 'ledger_id');
    }

     /**
     * Get all of the Purchase's daybook transaction.
     */
    public function dailyTransactions()
    {
        return $this->morphMany(DailyAccountTransaction::class, 'transactionable');
    }
    /**
     * Get all of the Purchase's cash flow transaction.
     */
    public function cashflowTransactions()
    {
        return $this->morphMany(CashFlow::class, 'cashflowable');
    }

}
