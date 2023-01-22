<?php

namespace App\Models\Purchase;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseItem extends Model
{
    use AutoTimeStamp, GlobalScope;
    protected $guarded =['id'];

    /**
     * Get the pruchase that owns the PurchaseItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pruchase(): BelongsTo
    {
       return $this->belongsTo(Purchase::class, 'purchase_id', 'id');
    }
}
