<?php

namespace App\Models;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use AutoTimeStamp, GlobalScope;
    
    protected $fillable = ['text','position', 'image', 'created_by', 'updated_by'];
}
