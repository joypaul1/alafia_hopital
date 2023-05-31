<?php

namespace App\Models;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reference extends Model
{
   use AutoTimeStamp,SoftDeletes,GlobalScope;

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
