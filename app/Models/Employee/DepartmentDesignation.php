<?php

namespace App\Models\Employee;

use App\Traits\AutoTimeStamp;
use Illuminate\Database\Eloquent\Model;

class DepartmentDesignation extends Model
{
    use AutoTimeStamp;

    protected $guarded =['id'];

    /**
     * Get the deparment that owns the DepartmentDesignation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function deparment()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    /**
     * Get the user that owns the DepartmentDesignation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function designation()
    {
        return $this->belongsTo(User::class, 'foreign_key', 'other_key');
    }
}
