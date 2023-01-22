<?php

namespace App\Models;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;

use Illuminate\Database\Eloquent\Model;

class EmailConfiguration extends Model
{
    // use HasFactory;
    use AutoTimeStamp, GlobalScope;
    
    protected $fillable = [
        "created_by",
        "updated_by",
        "driver",
        "host",
        "port",
        "encryption",
        "user_name" ,
        "password",
        "sender_name",
        "sender_email",
        'status'
    ];
}
