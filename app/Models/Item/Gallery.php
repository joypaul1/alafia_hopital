<?php

namespace App\Models\Item;

use App\Traits\GlobalScope;
use App\Traits\AutoTimeStamp;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use GlobalScope, AutoTimeStamp;
    
    protected $guarded =['id'];

    /**
     * Get all of the Gallary's image.
    */

    public function images()
    {
        return $this->morphMany(ImageGallery::class, 'galleriable');
    }

}
