<?php

namespace App\Models\Inventory;

use App\Models\Item\Item;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InventoryItem extends Model
{
    use AutoTimeStamp, GlobalScope;

    protected $guarded =['id'];

    /**
     * Get the warehouse that owns the InventoryItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(WareHouse::class, 'warehouses_id', 'id');
    }
    /**
     * Get the item that owns the InventoryItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }

}
