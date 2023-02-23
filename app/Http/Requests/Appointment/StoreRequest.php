<?php

namespace App\Http\Requests\Appointment;

use App\Helpers\InvoiceNumber;
use App\Models\Appointment\Appointment;
use App\Models\PaymentSystem;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

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
            'patient_Id'=> 'required|exists:patients,id',
            'doctorID'=> 'required|exists:doctors,id',
            'doctor_fee'=> 'required',
            'appointment_date'=> 'required',
            'appointment_schedule'=> 'required',
            'appointment_priority'=> 'required',
            'payment_method'=> 'required',
            'status'=> 'required',
        ];
    }

    public function getInvoiceNumber()
    {
        if (!Appointment::latest()->first()) {
            return 1;
        } else {
            return Appointment::latest()->first()->invoice_number + 1;
        }
    }

    public function storeData()
    {
        try {
            DB::beginTransaction();
                $data = $this->all();
                $data['invoice_number'] = (new InvoiceNumber)->invoice_num($this->getInvoiceNumber());
                $data['patient_id'] = $this->patient_Id;
                $data['doctor_id'] = $this->doctorID;
                $data['doctor_fee'] = $this->doctor_fees;
                $data['appointment_date'] = $this->appointment_date .' '.date("h:i:s");
                $data['doctor_appointment_schedule_id'] = $this->appointment_schedule;
                $data['appointment_priority'] = $this->appointment_priority;
                $data['payment_mode'] = PaymentSystem::find($this->payment_method)->name; //payment method name
                $data['appointment_status'] = $this->status;
                $data['payment_status'] = 'Paid';
                $appointment = Appointment::create($data);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex->getMessage();
        }




    }
}
