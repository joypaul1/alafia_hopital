<?php

namespace App\Models;


use App\Traits\AutoTimeStamp;
use Illuminate\Database\Eloquent\Model;

class SiteInfo extends Model
{

    use AutoTimeStamp;
    protected $guarded = ['id'];
    // protected $fillable = ['name', 'email','mobile','short_desc', 'logo', 'country', 'barcode_type','datetimezone', 'currency', 'created_by', 'updated_by'];

}
