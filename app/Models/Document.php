<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $guarded = ['id'];

    /**
     * Get the parent documentabel model 
     */
    public function documentable()
    {
        return $this->morphTo(__FUNCTION__, 'documentable_type', 'documentable_id');
    }
}
