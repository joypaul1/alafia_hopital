<?php

namespace App\Models;

use App\Models\Ledger\SupplierLedger;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use AutoTimeStamp, GlobalScope,SoftDeletes;

    protected $guarded = ['id'];

     /**
     * Get the supplier's image.
     */
    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    /**
     * Get the country that owns the Supplier
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    /**
     * Get the user associated with the Supplier
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ledgerReport(): HasOne
    {
        return $this->hasOne(SupplierLedger::class, 'supplier_id', 'id')->latest();
    }
}
