<?php

namespace App\Models\Account;

use App\Models\LedgerTransition;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AccountLedger extends Model
{
    use GlobalScope, AutoTimeStamp;

    protected $guarded =['id'];

    /**
     * Get the accountGroup that owns the AccountLedger
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function accountGroup(): BelongsTo
    {
        return $this->belongsTo(AccountGroup::class, 'account_group_id');
    }

    /**
     * Get the openingBalance associated with the AccountLedger
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function openingBalance(): HasOne
    {
        return $this->hasOne(AccountOpeningBalance::class, 'account_ledger_id');
    }

    /**
     * Get the transaction that owns the AccountLedger
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transaction(): HasOne
    {
        return $this->hasOne(LedgerTransition::class, 'ledger_id', 'id');
    }
}
