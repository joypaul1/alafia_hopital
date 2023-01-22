<?php

namespace App\Models\Inventory;

use App\Models\Country;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WareHouse extends Model
{
    use AutoTimeStamp, GlobalScope;

    protected $guarded =['id'];

    /**
     * Get the country that owns the WareHouse
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

}
