<?php

namespace App\Models\lab;

use App\Models\DailyAccountTransaction;
use App\Models\Doctor\Doctor;
use App\Models\Patient\Patient;
use App\Models\Transaction\CashFlow;
use App\Traits\AutoTimeStamp;
use App\Traits\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\lab\LabInvoiceTestDetails;
use App\Models\lab\LabInvoiceTestTubeDetails;
use App\Models\Reference;

class LabInvoice extends Model
{
    use GlobalScope, AutoTimeStamp;

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
        return $this->hasMany(LabInvoicePaymentHistory::class, 'lab_invoice_id', 'id');
    }

    /**
     * Get all of the testTube for the LabInvoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function labTestDetails(): HasMany
    {
        return $this->hasMany(LabInvoiceTestDetails::class, 'lab_invoice_id', 'id');
    }
    public function labTestTube(): HasMany
    {
        return $this->hasMany(LabInvoiceTestTubeDetails::class, 'lab_invoice_id', 'id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }
    public function reference()
    {
        return $this->belongsTo(Reference::class, 'reference_id', 'id');
    }
}
