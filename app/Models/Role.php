<?php

namespace App\Models;

use App\Traits\AutoTimeStamp;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use AutoTimeStamp;
    protected $fillable = ['name', 'slug', 'created_by', 'updated_by'];

    public function permissions() {

        return $this->belongsToMany(Permission::class,'roles_permissions');
            
     }
     
     public function users() {
     
        return $this->belongsToMany(Admin::class,'admins_roles');
            
     }
}
