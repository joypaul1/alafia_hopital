<?php

namespace App\Models\Service;


use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use App\Models\Service\ServiceName;
class ServiceInvoiceItems extends Model
{
    use GlobalScope, AutoTimeStamp;
    protected $guarded = ['id'];

    public function serviceName()
    {
        return $this->belongsTo(ServiceName::class, 'service_name_id', 'id');
    }

}
