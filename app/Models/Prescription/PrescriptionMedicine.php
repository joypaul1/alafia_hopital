<?php

namespace App\Models\Prescription;

use App\Models\Item\Item;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;


class PrescriptionMedicine extends Model
{
    use AutoTimeStamp, GlobalScope;
    protected $guarded = ['id'];

    /**
     * Get the items that owns the PrescriptionMedicine
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
