<?php

namespace App\Models\Production;


use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Production extends Model
{
    use AutoTimeStamp, GlobalScope;

    protected $guarded = ['id'];

    /**
     * Get all of the items for the Production
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(ProductionItem::class, 'production_id', 'id');
    }

    /**
     * Get all of the materials for the Production
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function materials(): HasMany
    {
        return $this->hasMany(ProductionItemMaterial::class, 'production_id', 'id');
    }

}
