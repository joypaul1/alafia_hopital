<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoTimeStamp;

class Submodule extends Model
{
    use HasFactory ;
    use AutoTimeStamp;

    protected $fillable = ['name', 'slug','module_id', 'created_by', 'updated_by'];

    public function modules()
    {
        return $this->belongsTo(Module::class, 'module_id', 'id');
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'submodule_id', 'id');
    }
}
