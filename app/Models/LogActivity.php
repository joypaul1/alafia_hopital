<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{


    /**
     * Get the admin that owns the LogActivity
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }
}
