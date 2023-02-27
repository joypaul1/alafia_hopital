<?php

namespace App\Models\Service;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceName extends Model
{
    use AutoTimeStamp, GlobalScope, SoftDeletes;
    protected $guarded = ['id'];

    public function serviceType(): HasOne
    {
        return $this->hasOne(SymptomType::class, 'id', 'service_type_id');
    }
}
