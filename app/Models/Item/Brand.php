<?php

namespace App\Models\Item;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use AutoTimeStamp,GlobalScope;
    protected $fillable =['name', 'image', 'created_by', 'updated_by'];
}
