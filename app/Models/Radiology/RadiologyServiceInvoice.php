<?php

namespace App\Models\Radiology;

use App\Models\DailyAccountTransaction;
use App\Models\Patient\Patient;
use App\Models\Transaction\CashFlow;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RadiologyServiceInvoice extends Model
{
    use GlobalScope, AutoTimeStamp, SoftDeletes;

    protected $guarded = ['id'];

    /**
     * Get all of the Purchase's daybook transaction.
     */
    public function dailyTransactions()
    {
        return $this->morphMany(DailyAccountTransaction::class, 'transactionable');
    }
    /**
     * Get all of the Purchase's cash flow transaction.
     */
    public function cashflowTransactions()
    {
        return $this->morphMany(CashFlow::class, 'cashflowable');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }

    public function paymentHistories()
    {
        return $this->hasMany(RadiologyServiceInvoicePaymentHistory::class, 'service_invoice_id', 'id');
    }

    /**
     * Get all of the testTube for the LabInvoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function itemDetails(): HasMany
    {
        return $this->hasMany(RadiologyServiceInvoiceItem::class, 'service_invoice_id', 'id');
    }

}
