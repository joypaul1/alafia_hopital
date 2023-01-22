<?php

namespace App\Models;

use App\Traits\AutoTimeStamp;

use Illuminate\Database\Eloquent\Model;

class PersonalLocker extends Model
{
    use AutoTimeStamp;
    protected $fillable = ['name', 'created_by', 'updated_by'];

    /**
     * Get all of the documents for the PersonalLocker
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documents()
    {
        return $this->hasMany(LockerDocumnet::class, 'locker_id', 'id');
    }
}
