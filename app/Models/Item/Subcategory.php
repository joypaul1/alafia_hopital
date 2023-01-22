<?php

namespace App\Models\Item;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{

    use GlobalScope, AutoTimeStamp, Sluggable;

    protected $guarded =['id'];


    /**
     * Get the category that owns the Subcategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * Get all of the childcategory for the subCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childcategories()
    {
        return $this->hasMany(Childcategory::class, 'subcategory_id', 'id');
    }
}
