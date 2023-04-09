<?php

namespace App\Http\Requests\Appointment\Dialysis;

use App\Helpers\InvoiceNumber;
use App\Models\Account\AccountLedger;
use App\Models\Appointment\Appointment;
use App\Models\Appointment\DialysisAppointment;
use App\Models\FinancialYearHistory;
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
        // return [];
        return [
            'patient_Id' => 'required|exists:patients,id',
            'employee_id' => 'nullable|exists:employees,id',
            'fee' => 'required',
            'appointment_date' => 'required',
            'schedule' => 'required',
            'payment_method' => 'required',
            'status' => 'required',
        ];
    }

    public function getInvoiceNumber()
    {
        if (!DialysisAppointment::latest()->first()) {
            return 1;
        } else {
            return DialysisAppointment::latest()->first()->invoice_number + 1;
        }
    }

    public function storeData()
    {
        try {
            DB::beginTransaction();
            $data = $this->all();
            $data['invoice_number'] = (new InvoiceNumber)->invoice_num($this->getInvoiceNumber());
            $data['patient_id'] = $this->patient_Id;
            $data['employee_id'] = $this->employee_id;
            $data['doctor_id'] = $this->doctor_id;
            $data['fee'] = $this->fee;
            $data['appointment_date'] = $this->appointment_date . ' ' . date("h:i:s");
            $data['appointment_priority'] = "Normal";
            $data['payment_mode'] = PaymentSystem::find($this->payment_method)->name; //payment method name
            $data['appointment_status'] = $this->status;
            $data['payment_status'] = 'Paid';
            $data['date'] = now();
            $data['discount_type'] = $this->discount_type;
            $data['discount'] =  Str::replace(',', '', $this->discount);
            $data['paid_amount'] =  Str::replace(',', '', $this->paid_amount);
            $data['subtotal_amount'] = Str::replace(',', '', $this->subtotal);
            $data['total_amount'] = Str::replace(',', '', $this->payable_amount);
            $data['due_amount'] =  Str::replace(',', '', $this->due_amount);

            $appointment = DialysisAppointment::create($data);
            // dd($appointment);
            // appointment paymentHistories
            $appointment->paymentHistories()->create([
                'ledger_id' => AccountLedger::first()->id,
                'payment_method' => PaymentSystem::find($this->payment_method)->name,
                'payment_system_id' => $this->payment_method,
                'date' => $appointment['appointment_date'],
                'note' => $this->payment_note,
                'paid_amount' => Str::replace(',', '', $this->paid_amount),
                'payment_received_id' => auth('admin')->id(),
            ]);

            //<----start of cash flow Transition------->
            $cashflowTransition = $appointment->cashflowTransactions()->create([
                'url'               => "Backend\Appointment\DialysisAppointmentController@show,['id' =>" . $appointment->id . "]",
                'cashflow_type'     => 'Payment',
                'description'       => 'Patient Payment',
                'date'              => $appointment['appointment_date'],
                'ledger_id'         => AccountLedger::first()->id,
                'payment_method'    => $this->payment_method,
            ]);

            // cashflowHistories
            $cashflowTransition->cashflowHistory()->create([
                'debit' => Str::replace(',', '', $this->paid_amount)
            ]);
            //<----end of cash flow Transition------->

            //<----start of dailyTransition book transaction------->
            $dailyTransition = $appointment->dailyTransactions()->create([
                'url'               =>  "Backend\Appointment\DialysisAppointmentController@show,['id' =>" . $appointment->id . "]",
                'description'       => 'Patient Payment',
                'transaction_type'  => 'Payment',
                'date'              =>  $appointment['appointment_date'],
                'reference_no'      =>  $appointment->invoice_number,
            ]);

            //credit transactionHistories // Payment increase
            $dailyTransition->transactionHistories()->create([
                'entry_name' => 'Patient Payment',
                'credit'      => Str::replace(',', '', $this->paid_amount),
            ]);

            //debit transactionHistories // amount increase
            $dailyTransition->transactionHistories()->create([
                'entry_name' => AccountLedger::find(AccountLedger::first()->id)->name,
                'debit' => Str::replace(',', '', $this->paid_amount),
            ]);

            // LedgerTransition --->increment payment
            LedgerTransition::updateOrCreate([
                'ledger_id' => AccountLedger::first()->id,
                'date'     => FinancialYearHistory::latest()->first()->start_date
            ], [
                'debit' => DB::raw('debit+' . Str::replace(',', '', $this->paid_amount))
            ]);

            DB::commit();
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'msg' => $ex->getMessage(), $ex->getLine()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Created Successfully', 'data' => $appointment->id]);
    }
}
