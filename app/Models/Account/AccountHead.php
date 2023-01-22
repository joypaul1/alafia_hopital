<?php

namespace App\Models\Account;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AccountHead extends Model
{
    use GlobalScope, AutoTimeStamp;

    protected $guarded =['id'];

    /**
     * Get all of the groups for the AccountHead
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function groups(): HasMany
    {
        return $this->hasMany(AccountGroup::class, 'account_head_id', 'id');
    }
}
