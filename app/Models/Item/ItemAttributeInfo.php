<?php

namespace App\Models\Item;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;

use Illuminate\Database\Eloquent\Model;

class ItemAttributeInfo extends Model
{
    use GlobalScope, AutoTimeStamp;
    
    protected $guarded =['id'];
}
