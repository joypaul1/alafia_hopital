<?php

namespace App\Models;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    use AutoTimeStamp, GlobalScope;

    protected $fillable = [
		'title', 'start', 'end', 'created_by', 'updated_by', 'status'
	];
}
