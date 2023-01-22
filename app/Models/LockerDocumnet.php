<?php

namespace App\Models;

use App\Traits\AutoTimeStamp;

use Illuminate\Database\Eloquent\Model;

class LockerDocumnet extends Model
{
    use AutoTimeStamp;

    protected $guarded = ['id'];

    public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
