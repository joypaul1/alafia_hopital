<?php

namespace App\Models\Item;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ItemAttribute extends Model
{
    use GlobalScope, AutoTimeStamp;
    
    protected $guarded =['id'];

    /**
     * Get the value associated with the ItemAttribute
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function value(): HasOne
    {
        return $this->hasOne(AttributeValue::class, 'attribute_id');
    }
}
