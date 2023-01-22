<?php
namespace App\Models\Employee;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use  AutoTimeStamp,GlobalScope;

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'emp_id',
        'reference_id',
        'nid',
        'note',
        'present_address',
        'permanent_address',
        'joining_date',
        'password',
        'department_id',
        'designation_id',
        'shift_id',
        'image',
    ];

    /**
     * Get the department that owns the Employee
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the designation that owns the Employee
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    /**
     * Get the shift that owns the Employee
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }
}
