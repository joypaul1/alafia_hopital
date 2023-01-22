<?php

namespace App\Models\Item;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Item extends Model
{
    use GlobalScope, AutoTimeStamp,Sluggable;

    protected $guarded =['id'];

    /**
     * Get all of the attributes for the Item
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attributes(): HasMany
    {
        return $this->hasMany(ItemAttribute::class, 'item_id');
    }
    /**
     * Get all of the variants for the Item
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function variants(): HasMany
    {
        return $this->hasMany(ItemVariants::class, 'item_id');
    }

    /**
     * Get the deliveryInfo associated with the Item
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function deliveryInfo(): HasOne
    {
        return $this->hasOne(DeliveryInfoItem::class, 'item_id');
    }

    /**
     * Get all of the galleries for the Item
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class, 'item_id', 'id');
    }

    /**
     * Get all of the attributeInfos for the Item
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attributeInfos(): HasMany
    {
        return $this->hasMany(ItemAttributeInfo::class, 'item_id');
    }

    /**
     * Get the metatag associated with the Item
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function metatag(): HasOne
    {
        return $this->hasOne(ItemMetaTag::class, 'item_id');
    }


    /**
     * Get the category that owns the Item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * Get the subcategory that owns the Item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id', 'id');
    }

    /**
     * Get the childcategory that owns the Item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function childcategory(): BelongsTo
    {
        return $this->belongsTo(Childcategory::class, 'childcategory_id', 'id');
    }


    /**
     * Get the unit that owns the Item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    /**
     * Get the brand that owns the Item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
   
}
