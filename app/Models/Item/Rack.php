<?php

namespace App\Models\Item;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;

class Rack extends Model
{
    use GlobalScope, AutoTimeStamp;
    
    protected $guarded =['id'];

    /**
     * Get all of the rows for the Rack
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rows()
    {
        return $this->hasMany(Row::class, 'row_id', 'id');
    }
}
