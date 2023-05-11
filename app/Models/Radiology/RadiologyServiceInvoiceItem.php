<?php

namespace App\Models\Radiology;


use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;

class RadiologyServiceInvoiceItem extends Model
{
    use GlobalScope, AutoTimeStamp;
    protected $guarded = ['id'];

    public function serviceName()
    {
        return $this->belongsTo(RadiologyServiceName::class, 'service_name_id', 'id');
    }

    public function serviceInvoice()
    {
        return $this->belongsTo(RadiologyServiceInvoice::class, 'service_invoice_id', 'id');
    }
}
