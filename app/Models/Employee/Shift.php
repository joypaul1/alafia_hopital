<?php

namespace App\Models\Employee;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use  AutoTimeStamp,GlobalScope;
    protected $guarded =['id'];

    /**
     * Get all of the employees for the Shift
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    
}
