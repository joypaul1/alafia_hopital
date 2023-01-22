<?php

namespace App\Models\Item;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;

class ImageGallery extends Model
{
    use GlobalScope, AutoTimeStamp;
    
    protected $guarded =['id'];

    public function galleriable()
    {
        return $this->morphTo(__FUNCTION__, 'galleriable_type', 'galleriable_id');
    }

   
}
