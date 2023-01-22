<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branches';
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'status',
        'created_at',
        'updated_at',
    ];
}
