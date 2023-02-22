<?php

namespace App\Models\SiteConfig;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;

class BloodBankType extends Model
{
    use AutoTimeStamp,GlobalScope;

    protected $guarded = ['id'];

    public function type()
    {
        return $this->belongsTo(BloodBankType::class, 'type_id', 'id');
    }
}
