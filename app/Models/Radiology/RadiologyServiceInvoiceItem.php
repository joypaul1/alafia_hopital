<?php

namespace App\Models\Radiology;

use App\Models\Doctor\Doctor;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

     /**
      * Get the approvedBy that owns the RadiologyServiceInvoiceItem
      *
      * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
      */
     public function approvedBy(): BelongsTo
     {
         return $this->belongsTo(Doctor::class, 'approved_by', 'id');
     }
}
