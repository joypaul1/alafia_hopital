<?php

namespace App\Models\Pos;

use App\Models\Country;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use AutoTimeStamp, GlobalScope;

    protected $guarded = ['id'];

     /**
     * Get the supplier's image.
     */
    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    /**
     * Get the country that owns the Outlet
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
