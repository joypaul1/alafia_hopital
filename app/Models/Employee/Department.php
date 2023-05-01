<?php

namespace App\Models\Employee;

use App\Models\Admin;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use AutoTimeStamp, GlobalScope;
    protected $guarded =['id'];


    /**
     * Get all of the departmentDesignation for the Department
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function departmentDesignations()
    {
        return $this->hasMany(DepartmentDesignation::class, 'department_id', 'id');
    }
    /**
     * The designations that belong to the Department
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    // public function designations()
    // {
    //     return $this->belongsToMany(Designation::class, 'department_designations', 'department_id', 'designation_id');
    // }

    public function designations()
    {
        return $this->belongsToMany(Designation::class, 'designation_department', 'department_id', 'designation_id');
    }

}
