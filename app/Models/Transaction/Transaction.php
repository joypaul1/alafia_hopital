<?php

namespace App\Models\Transaction;

use App\Models\DailyAccountTransaction;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use AutoTimeStamp, GlobalScope, SoftDeletes;

    protected $guarded =['id'];

    /**
     * Get all of the histories for the TransactionHistory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function histories(): HasMany
    {
        return $this->hasMany(TransactionHistory::class, 'transaction_id', 'id');
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
