<?php

namespace App\Models;

use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Symptom extends Model
{
    use AutoTimeStamp, GlobalScope,SoftDeletes;
    protected $guarded = ['id'];

    public function symptomType(): HasOne
    {
        return $this->hasOne(SymptomType::class, 'id', 'symptom_type_id');
    }
}
