<?php

namespace App\Models\Movie;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use AutoTimeStamp, GlobalScope;
    protected $guarded = ['id'];
}
