<?php

namespace App\Models\Item;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;

use Illuminate\Database\Eloquent\Model;

class Row extends Model
{
    use GlobalScope, AutoTimeStamp;
    
    protected $guarded =['id'];

    /**
     * Get the rack that owns the Row
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rack()
    {
        return $this->belongsTo(Rack::class, 'rack_id', 'id');
    }
}
