<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoTimeStamp;


class Module extends Model
{
    use HasFactory;
    use AutoTimeStamp;

    protected $fillable = ['name', 'slug', 'created_by', 'updated_by'];

    public function submodules()
    {
        return $this->hasMany(Submodule::class, 'module_id', 'id');
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'module_id', 'id');
    }

}
