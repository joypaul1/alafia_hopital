<?php

namespace App\Models\Service;

use App\Models\Item\Unit;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceName extends Model
{
    use AutoTimeStamp, GlobalScope, SoftDeletes;
    protected $guarded = ['id'];

    public function serviceType(): HasOne
    {
        return $this->hasOne(ServiceType::class, 'id', 'service_type_id');
    }

    /**
     * Get the unit that owns the ServiceName
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }
}
