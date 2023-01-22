<?php

namespace App\Models;

use App\Models\Order\OrderShipment;
use App\Models\Order\OrderTable;
use App\Models\Transaction\CashFlow;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use AutoTimeStamp, GlobalScope;

    protected $guarded = ['id'];


    /**
     * Get all of the orderItems for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }


   /**
    * Get all of the paymentHistories for the Order
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function paymentHistories(): HasMany
   {
       return $this->hasMany(OrderPaymentHistory::class, 'order_id', 'id');
   }
    /**
     * Get all of the orderStatus for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderStatus(): HasOne
    {
        return $this->hasOne(OrderStatus::class, 'order_id', 'id')->latest();
    }
    public function orderLastStatus(): HasMany
    {
        return $this->hasMany(OrderStatus::class, 'order_id', 'id')->latest();

    }

    /**
     * Get all of the orderItems for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderShipment(): HasOne
    {
        return $this->hasOne(OrderShipment::class, 'order_id', 'id');
    }

    /**
     * Get the user that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
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


    /**
     * Get all of the orderTables for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderTables(): HasMany
    {
        return $this->hasMany(OrderTable::class, 'order_id', 'id');
    }
}
