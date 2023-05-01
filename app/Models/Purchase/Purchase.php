<?php

namespace App\Models\Purchase;

use App\Models\DailyAccountTransaction;
use App\Models\DailyAccountTransition;
use App\Models\Document;
use App\Models\Inventory\WareHouse;
use App\Models\Supplier;
use App\Models\Transaction\CashFlow;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
   use AutoTimeStamp, GlobalScope, SoftDeletes;
   protected $guarded =['id'];

   /**
    * Get all of the purchaseItems for the Purchase
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function purchaseItems(): HasMany
    {
        return $this->hasMany(PurchaseItem::class, 'purchase_id', 'id');
    }

    /**
     * Get all of the paymentHistories for the Purchase
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paymentHistories(): HasMany
    {
        return $this->hasMany(PurchasePaymentHistory::class, 'purchase_id', 'id');
    }

    /**
     * Get all of the shipmentHistory for the Purchase
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shipmentHistory(): HasMany
    {
        return $this->hasMany(PurchaseShipmentHistory::class, 'purchase_id', 'id');
    }

    /**
     * Get the Purchase's document.
     */
    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
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
     * Get the supplier that owns the Purchase
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    /**
     * Get the warehouse that owns the Purchase
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(WareHouse::class, 'warehouse_id', 'id');
    }

}
