<?php

namespace App\Http\Requests\Pathology\Lab;

use App\Helpers\InvoiceNumber;
use App\Models\Account\AccountLedger;
use App\Models\FinancialYearHistory;
use App\Models\lab\LabInvoice;
use App\Models\LedgerTransition;
use App\Models\PaymentSystem;
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
            'labTest_id' => 'required|array',
            'labTest_id.*' => 'required|exists:lab_tests,id',
            'test_price' => 'required|array',
            'test_price.*' => 'required|numeric',
            'testTube_id' => 'nullable|array',
            'testTube_id.*' => 'nullable|exists:lab_test_tubes,id',
            'testTube_price' => 'nullable|array',
            'testTube_price.*' => 'nullable|numeric',
            'testSubTotal' => 'required',
            'tubeSubTotal' => 'required',
        ];
    }
    public function getInvoiceNumber()
    {
        if (!LabInvoice::latest()->first()) {
            return 1;
        } else {
            return LabInvoice::latest()->first()->invoice_no + 1;
        }
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeData()
    {

        try {
            DB::beginTransaction();
            $data['invoice_no']         = (new InvoiceNumber)->invoice_num($this->getInvoiceNumber());
            $data['patient_id']         = $this->patient_id;
            $data['date']               = date('Y-m-d', strtotime($this->date)) . ' ' . date('h:i:s');
            $data['paid_amount']        = Str::replace(',', '', ($this->tubeSubTotal + $this->testSubTotal));
            $data['total_amount']       = $data['paid_amount'];
            $labInvoice                 = LabInvoice::create($data);
            // dd($labInvoice);
            // hasMany labTest data insert
            foreach ($this->labTest_id as $key => $labTest) {
                $v= $labInvoice->labTestDetails()->create([
                    'lab_test_id' => $labTest,
                    'price' => $this->test_price[$key],
                ]);

            }
            // hasMany labTestTube data insert
            foreach ($this->testTube_id as $key => $testTube) {
                $labInvoice->labTestTube()->create([
                    'lab_test_tube_id' => $testTube,
                    'price' => $this->testTube_price[$key],
                ]);

            }
            //<----start of cash flow Transition------->
            // cashflowTransactions
            $cashflowTransition = $labInvoice->cashflowTransactions()->create([
                'url'               => "Backend\Pathology\LabTestController@show,['id' =>" . $labInvoice->id . "]",
                'cashflow_type'     => 'labInvoice',
                'description'       => 'labInvoice Item',
                'date'              => $labInvoice->date,
                'ledger_id'         => AccountLedger::first()->id,
                'payment_method'    => PaymentSystem::first()->id,

            ]);
            // dd(  $cashflowTransition);

            // cashflowHistories
            $cashflowTransition->cashflowHistory()->create([
                'debit' => $labInvoice->total
            ]);

            //<----end of cash flow Transition------->

            //<----start of daily book transaction------->
            // dailyTransition
            $dailyTransition = $labInvoice->dailyTransactions()->create([
                'url'               => "Backend\Pathology\LabTestController@show,['id' =>" . $labInvoice->id . "]",
                'description'       => 'labInvoice Item',
                'transaction_type'  => 'labInvoice',
                'date'              =>  $this->date,
                'reference_no'      => $labInvoice->invoice_no,
            ]);

            //labInvoice full amount
            $dailyTransition->transactionHistories()->create([
                'entry_name' => 'labInvoice Item',
                'debit' => $labInvoice->total_amount,
            ]);

            $labInvoice->paymentHistories()->create([
                'ledger_id' => AccountLedger::first()->id,
                'payment_method' => PaymentSystem::first()->id,
                'payment_system_id' => PaymentSystem::first()->name,
                'date' => $this->date,
                'note' => $this->payment_note,
                'paid_amount' => $labInvoice->total_amount,
                'payment_received_id' => auth('admin')->id(),
            ]);

            // LedgerTransition --->increment costing
            LedgerTransition::updateOrCreate([
                'ledger_id' => AccountLedger::first()->id,
                'date'     => FinancialYearHistory::latest()->first()->start_date
            ], [
                'debit' => DB::raw('debit +' . $labInvoice->total_amount)
            ]);
            // dd($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['msg' => $e->getMessage(), $e->getLine(), 'status' => false], 400);
        }
        return response()->json(['data' =>$labInvoice->id, 'status' => true], 200);
    }
}
