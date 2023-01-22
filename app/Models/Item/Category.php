<?php

namespace App\Models\Item;

use App\Traits\Sluggable;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Category extends Model
{
use GlobalScope, AutoTimeStamp, Sluggable;

    protected $guarded =['id'];

    /**
     * Get all of the subcategory for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class, 'category_id', 'id');
    }

    /**
     * Get all of the comments for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function childcategories(): HasManyThrough
    {
        return $this->hasManyThrough(
            Childcategory::class,
            Subcategory::class,
            'category_id', // Foreign key on the cars table...
            'subcategory_id', // Foreign key on the owners table...
            'id', // Local key on the mechanics table...
            'id' // Local key on the cars table...
        );
    }


}
