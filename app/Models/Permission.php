<?php

namespace App\Models;

use App\Traits\AutoTimeStamp;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use AutoTimeStamp;

    public function roles() {

        return $this->belongsToMany(Role::class,'roles_permissions');
            
     }
     
    public function users() {
     
        return $this->belongsToMany(Admin::class,'admins_permissions');
    }
}
