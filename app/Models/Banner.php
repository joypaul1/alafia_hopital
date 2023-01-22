<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;

class Banner extends Model
{
    use AutoTimeStamp, GlobalScope;
    
    protected $fillable = ['position', 'image', 'created_by', 'updated_by'];

    

}
