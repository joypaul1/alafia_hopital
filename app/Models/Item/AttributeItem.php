<?php

namespace App\Models\Item;

use App\Models\Item\Item;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttributeItem extends Model
{
    use GlobalScope, AutoTimeStamp;
    
    protected $guarded =['id'];

    /**
     * Get the item that owns the AttributeItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class,'item_id');
    }
}
