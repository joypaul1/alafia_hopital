<?php

namespace App\Models\Item;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Childcategory extends Model
{
    use GlobalScope, AutoTimeStamp,Sluggable;
    
    protected $guarded =['id'];

     /**
     * Get the childcategory that owns the category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

     /**
     * Get the childcategory that owns the subcategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id', 'id');
    }
}
