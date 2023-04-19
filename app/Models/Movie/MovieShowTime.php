<?php

namespace App\Models\Movie;

use App\Traits\AutoTimeStamp;
use Illuminate\Database\Eloquent\Model;

class MovieShowTime extends Model
{
    use AutoTimeStamp;
    protected $guarded = ['id'];
}
