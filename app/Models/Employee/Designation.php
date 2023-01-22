<?php

namespace App\Models\Employee;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use AutoTimeStamp, GlobalScope;

    protected $guarded =['id'];

    /**
     * Get the department that owns the Designation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class, 'designation_id', 'id');
    }

    /**
     * The departments that belong to the Designation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function departments()
    {
        return $this->belongsToMany(Department::class, 'department_designations', 'department_id', 'designation_id');
    }

}
