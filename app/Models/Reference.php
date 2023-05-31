<?php

namespace App\Models;

use App\Traits\AuthScopes;
use App\Traits\AutoTimeStamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reference extends Model
{
   use AuthScopes,AutoTimeStamp,SoftDeletes;

   protected $guarded = ['id'];

   /**
    * Get all of the history for the Reference
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function history(): HasMany
   {
       return $this->hasMany(CommissionHistory::class, 'reference_id', 'id');
   }
}
