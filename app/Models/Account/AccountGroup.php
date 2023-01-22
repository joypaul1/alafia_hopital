<?php

namespace App\Models\Account;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AccountGroup extends Model
{
    use GlobalScope, AutoTimeStamp;

    protected $guarded =['id'];


    /**
     * Get the accountHead that owns the AccountGroup
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function accountHead(): BelongsTo
    {
        return $this->belongsTo(AccountHead::class, 'account_head_id', 'id');
    }

    /**
     * Get all of the ledgers for the AccountGroup
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ledgers(): HasMany
    {
        return $this->hasMany(AccountLedger::class, 'account_group_id', 'id');
    }
}
