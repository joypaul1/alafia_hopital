<?php

namespace App\Models;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyAccountTransaction extends Model
{

    use AutoTimeStamp, GlobalScope,SoftDeletes;
    protected $guarded = ['id'];

     /**
     * Get the parent transition model
     */
    public function transactionable()
    {
        return $this->morphTo(__FUNCTION__, 'transactionable_type', 'transactionable_id');
    }

    public function transactionHistories()
    {
        return $this->hasMany(AccountTransactionHistory::class, 'account_transaction_id', 'id');
    }
}
