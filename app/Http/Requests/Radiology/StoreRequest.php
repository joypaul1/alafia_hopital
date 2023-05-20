<?php

namespace App\Http\Requests\Radiology;

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
            'test_price' => 'required|array',
            'test_price.*' => 'required|numeric',
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
            if (Str::replace(',', '', ($this->payable_amount + 0)) == Str::replace(',', '', ($this->paid_amount ?? 0 + 0))) {
                $payment_status = 'paid';
            } else {
                $payment_status = 'due';
            }

            DB::beginTransaction();
            $data['invoice_no']         = (new InvoiceNumber)->invoice_num($this->getInvoiceNumber());
            $data['patient_id']         = $this->patient_id;
            $data['date']               = date('Y-m-d', strtotime($this->date)) . ' ' . date('h:i:s');
            $data['subtotal_amount']    = Str::replace(',', '', ($this->testSubTotal));
            // $data['discount_type']      = $this->discount_type;
            // $data['discount']           = Str::replace(',', '', ($this->discount ?? 0));
            // $data['discount_amount']    = Str::replace(',', '', ($this->discount_amount ?? 0));
            $data['paid_amount']        = Str::replace(',', '', ($this->paid_amount ?? 0));
            $data['payment_status']     = $payment_status;
            $data['total_amount']       = Str::replace(',', '', ($this->payable_amount));
            $data['doctor_id']          = $this->doctor_id;
            $serviceInvoice             = RadiologyServiceInvoice::create($data);
            // dd($this->discount);
            foreach ($this->service_id as $key => $serviceId) {
                $v = $serviceInvoice->itemDetails()->create([
                    'service_name_id'   => $serviceId,
                    'qty'               => 1.00,
                    'discount_type'     => $this['discount_type'][$key],
                    'discount'          =>  Str::replace(',', '', ($this['discount'][$key]?? 0)),
                    'discount_amount'   =>  Str::replace(',', '', ($this['discount_amount'][$key]?? 0)),
                    'price'             =>  Str::replace(',', '', ($this['test_price'][$key]?? 0)),
                    'subtotal'          =>  Str::replace(',', '', ($this['subtotal'][$key]?? 0)),
                    'status'            => 'pending',
                ]);

            }
            if ($this->paid_amount > 0) {
                $serviceInvoice->paymentHistories()->create([
                    'ledger_id'             => $this->payment_account,
                    'payment_method'        => $this->payment_method,
                    // 'payment_system_id'     => $this->payment_method,
                    'date'                  => date('Y-m-d'),
                    'note'                  => $this->payment_note,
                    'paid_amount'           => Str::replace(',', '', $this->paid_amount),
                    'payment_received_id'   => auth('admin')->id(),
                ]);
                //<----start of cash flow Transition------->
                // cashflowTransactions
                $cashflowTransition = $serviceInvoice->cashflowTransactions()->create([
                    'url'               => "Backend\Radiology\RadiologyServiceInvoiceController@show,['id' =>" . $serviceInvoice->id . "]",
                    'cashflow_type'     => 'RadiologyServiceInvoice',
                    'description'       => 'RadiologyServiceInvoice Item',
                    'date'              => $serviceInvoice->date,
                    'ledger_id'         => $this->payment_account,
                    'payment_method'    => $this->payment_method,

                ]);


                // cashflowHistories
                $cashflowTransition->cashflowHistory()->create([
                    'debit' => Str::replace(',', '',  $serviceInvoice->paid_amount)
                ]);

                //<----end of cash flow Transition------->

                //<----start of daily book transaction------->
                // dailyTransition
                $dailyTransition = $serviceInvoice->dailyTransactions()->create([
                    'url'               => "Backend\Radiology\RadiologyServiceInvoiceController@show,['id' =>" . $serviceInvoice->id . "]",
                    'description'       => 'RadiologyServiceInvoice Item',
                    'transaction_type'  => 'RadiologyServiceInvoice',
                    'date'              =>  $this->date,
                    'reference_no'      => $serviceInvoice->invoice_no,
                ]);

                //serviceInvoice full amount
                $dailyTransition->transactionHistories()->create([
                    'entry_name' => 'serviceInvoice Item',
                    'debit' => Str::replace(',', '',  $serviceInvoice->paid_amount),
                ]);


                // LedgerTransition --->increment costing
                $leg = LedgerTransition::updateOrCreate([
                    'ledger_id' => $this->payment_account,
                    'date'     => FinancialYearHistory::latest()->first()->start_date
                ], [
                    'debit' => DB::raw('debit +' . Str::replace(',', '',  $serviceInvoice->paid_amount))
                ]);
            }


            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage(), $e->getLine());
            return response()->json(['msg' => $e->getMessage(), $e->getLine(), 'status' => false], 400);
        }
        return response()->json(['data' => $serviceInvoice->id, 'status' => true], 200);
    }

    public function paymentStore($labInvoice, $request)
    {
        // dd($labInvoice);
        if ($request->paid_amount < 0) {
            return response()->json(['msg' => 'Paid amount can not be negative or 0', 'status' => false], 400);
        }
        try {
            DB::beginTransaction();
            if (Str::replace(',', '', ($request->payable_amount + 0)) == Str::replace(',', '', ($request->paid_amount ?? 0 + 0))) {
                $payment_status = 'paid';
            } else {
                $payment_status = 'due';
            }
            // dd($payment_status, $request->payable_amount,$request->paid_amount);
            $labInvoice->update([
                'paid_amount'   => $labInvoice->paid_amount + Str::replace(',', '',  $request->paid_amount + 0),
                'payment_status' => $payment_status
            ]);

            $labInvoice->paymentHistories()->create([
                'ledger_id' => AccountLedger::first()->id,
                'payment_method' => PaymentSystem::first()->id,
                'payment_system_id' => PaymentSystem::first()->name,
                'date' => $request->date,
                'note' => $request->payment_note,
                'paid_amount' => Str::replace(',', '',  $request->paid_amount),
                'payment_received_id' => auth('admin')->id(),
            ]);

            //<----start of cash flow Transition------->
            // cashflowTransactions
            $cashflowTransition = $labInvoice->cashflowTransactions()->create([
                'url'               => "Backend\Pathology\LabTestController@show,['id' =>" . $labInvoice->id . "]",
                'cashflow_type'     => 'labInvoice',
                'description'       => 'labInvoice Payment',
                'date'              => $request->date,
                'ledger_id'         => AccountLedger::first()->id,
                'payment_method'    => PaymentSystem::first()->id,

            ]);
            // dd(  $cashflowTransition);

            // cashflowHistories
            $cashflowTransition->cashflowHistory()->create([
                'debit' => Str::replace(',', '',  $request->paid_amount)
            ]);

            //<----end of cash flow Transition------->

            //<----start of daily book transaction------->
            // dailyTransition
            $dailyTransition = $labInvoice->dailyTransactions()->create([
                'url'               => "Backend\Pathology\LabTestController@show,['id' =>" . $labInvoice->id . "]",
                'description'       => 'labInvoice Item',
                'transaction_type'  => 'labInvoice',
                'date'              =>  $request->date,
                'reference_no'      => $labInvoice->invoice_no,
            ]);

            //labInvoice full amount
            $dailyTransition->transactionHistories()->create([
                'entry_name' => 'labInvoice Item',
                'debit' => Str::replace(',', '',  $request->paid_amount),
            ]);



            // LedgerTransition --->increment costing
            LedgerTransition::updateOrCreate([
                'ledger_id' => AccountLedger::first()->id,
                'date'     => FinancialYearHistory::latest()->first()->start_date
            ], [
                'debit' => DB::raw('debit +' . Str::replace(',', '',  $request->paid_amount))
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['msg' => $e->getMessage(), $e->getLine(), 'status' => false], 400);
        }
        return response()->json(['data' => $labInvoice->id, 'status' => true], 200);
    }
}
