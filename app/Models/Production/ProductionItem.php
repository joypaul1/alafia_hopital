<?php

namespace App\Models\Production;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;

class ProductionItem extends Model
{
    use AutoTimeStamp, GlobalScope;

    protected $guarded = ['id'];

}
