<?php

namespace App\Http\Requests\Pathology\Lab;

use App\Helpers\InvoiceNumber;
use App\Models\Account\AccountLedger;
use App\Models\FinancialYearHistory;
use App\Models\lab\LabInvoice;
use App\Models\lab\LabInvoiceTestDetails;
use App\Models\lab\LabTest;
use App\Models\LedgerTransition;
use App\Models\PaymentSystem;
use App\Models\Radiology\RadiologyServiceInvoice;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'patient_id' => 'required|exists:patients,id',
            'date' => 'required',
            'service_id' => 'required|array',
            'service_id.*' => 'required|exists:lab_tests,id',
            'doctor_id' => 'nullable|exists:doctors,id',
            'price' => 'required|array',
            'price.*' => 'required|numeric',
            'testSubTotal' => 'required',

        ];
    }
    public function getInvoiceNumber()
    {
        if (!RadiologyServiceInvoice::latest()->first()) {
            return 1;
        } else {
            return RadiologyServiceInvoice::latest()->first()->invoice_no + 1;
        }
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeData()
    {
        // dd($this->all());
        try {
            DB::beginTransaction();
            $data['invoice_no']         = (new InvoiceNumber)->invoice_num($this->getInvoiceNumber());
            $data['patient_id']         = $this->patient_id;
            $data['date']               = date('Y-m-d', strtotime($this->date)) . ' ' . date('h:i:s');
            $data['subtotal_amount']    = Str::replace(',', '', ($this->testSubTotal));
            $data['discount_type']      = $this->discount_type;
            $data['discount']           = Str::replace(',', '', ($this->discount));
            $data['discount_amount']    = Str::replace(',', '', ($this->discount_amount));

            $data['paid_amount']        = Str::replace(',', '', ($this->paid_amount));
            $data['payment_status']     = Str::replace(',', '', ($this->payable_amount)) > Str::replace(',', '', ($this->paid_amount)) ? 'due' : 'paid';
            $data['total_amount']       = Str::replace(',', '', ($this->payable_amount));
            $data['doctor_id']          = $this->doctor_id;
            // dd($data);
            $serviceInvoice             = RadiologyServiceInvoice::create($data);

            foreach ($this->service_id as $key => $serviceId) {
                // dd($key,$serviceId);
                $v=$serviceInvoice->itemDetails()->create([
                    'service_name_id'   => $serviceId,
                    'qty'       => 1.00,
                    'service_price' => $this['price'][$key],
                    'subtotal'  => $this['price'][$key],
                ]);

            }
            // dd($this->all());
            $paymentHistories= $serviceInvoice->paymentHistories()->create([
                'ledger_id'             => $this->payment_account,
                'payment_method'        => PaymentSystem::whereId($this->payment_method)->first()->name,
                'payment_system_id'     => $this->payment_method,
                'date'                  => date('Y-m-d'),
                'note'                  => $this->payment_note,
                'paid_amount'           => Str::replace(',', '', $this->paid_amount),
                'payment_received_id'   => auth('admin')->id(),
            ]);


            // dd($paymentHistories);
            //<----start of cash flow Transition------->
            // cashflowTransactions
            $cashflowTransition = $serviceInvoice->cashflowTransactions()->create([
                'url'               => "Backend\Radiology\RadiologyServiceInvoiceController@show,['id' =>" . $serviceInvoice->id . "]",
                'cashflow_type'     => 'serviceInvoice',
                'description'       => 'serviceInvoice Item',
                'date'              => $serviceInvoice->date,
                'ledger_id'         => $this->payment_account,
                'payment_method'    =>$this->payment_method,

            ]);
            // dd(  $cashflowTransition);

            // cashflowHistories
            $cashflowTransition->cashflowHistory()->create([
                'debit' => Str::replace(',', '',  $serviceInvoice->paid_amount)
            ]);

            //<----end of cash flow Transition------->

            //<----start of daily book transaction------->
            // dailyTransition
            $dailyTransition = $serviceInvoice->dailyTransactions()->create([
                'url'               => "Backend\Radiology\RadiologyServiceInvoiceController@show,['id' =>" . $serviceInvoice->id . "]",
                'description'       => 'serviceInvoice Item',
                'transaction_type'  => 'serviceInvoice',
                'date'              =>  $this->date,
                'reference_no'      => $serviceInvoice->invoice_no,
            ]);

            //serviceInvoice full amount
            $dailyTransition->transactionHistories()->create([
                'entry_name' => 'serviceInvoice Item',
                'debit' => Str::replace(',', '',  $serviceInvoice->paid_amount),
            ]);


            // LedgerTransition --->increment costing
            $leg=LedgerTransition::updateOrCreate([
                'ledger_id' => $this->payment_account,
                'date'     => FinancialYearHistory::latest()->first()->start_date
            ], [
                'debit' => DB::raw('debit +' . Str::replace(',', '',  $serviceInvoice->paid_amount))
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage(), $e->getLine());
            return response()->json(['msg' => $e->getMessage(), $e->getLine(), 'status' => false], 400);
        }
        return response()->json(['data' => $serviceInvoice->id, 'status' => true], 200);
    }
}
