<?php

namespace App\Models;

use App\Models\Account\AccountLedger;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderPaymentHistory extends Model
{
    use AutoTimeStamp, GlobalScope;

    protected $guarded = ['id'];

    /**
     * Get the ledger that owns the OrderPaymentHistory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ledger(): BelongsTo
    {
        return $this->belongsTo(AccountLedger::class, 'ledger_id', 'id');
    }


    /**
     * Get the paymentSystem that owns the OrderPaymentHistory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentSystem(): BelongsTo
    {
        return $this->belongsTo(PaymentSystem::class, 'payment_system_id', 'id');
    }
}
