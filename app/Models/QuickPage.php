<?php

namespace App\Models;

// 
use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;

class QuickPage extends Model
{
    use AutoTimeStamp, GlobalScope;

    protected $fillable = ['position', 'description','name', 'slug', 'created_by', 'updated_by'];
}
