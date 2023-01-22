<?php

namespace App\Models\Transaction;

use App\Models\Account\AccountLedger;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionHistory extends Model
{
    use AutoTimeStamp, GlobalScope;

    protected $guarded =['id'];


    /**
     * Get the ledger that owns the TransactionHistory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ledger(): BelongsTo
    {
        return $this->belongsTo(AccountLedger::class, 'ledger_id', 'id');
    }

}
