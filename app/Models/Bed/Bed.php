<?php

namespace App\Models\Bed;

use App\Models\Floor;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bed extends Model
{
    use GlobalScope, AutoTimeStamp,SoftDeletes;

    protected $guarded =['id'];

    public function bedGroup()
    {
        return $this->belongsTo(BedGroup::class, 'bed_group_id');
    }

    public function bedType()
    {
        return $this->belongsTo(BedType::class, 'bed_type_id');
    }

    public function bedCabin()
    {
        return $this->belongsTo(BedCabin::class, 'bed_cabin_id');
    }

    public function bedWard()
    {
        return $this->belongsTo(BedWard::class, 'bed_ward_id');
    }

    public function floor()
    {
        return $this->belongsTo(Floor::class, 'floor_id');
    }


}
