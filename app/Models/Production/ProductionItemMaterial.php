<?php

namespace App\Models\Production;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;

class ProductionItemMaterial extends Model
{
    use AutoTimeStamp, GlobalScope;

    protected $guarded = ['id'];

}
