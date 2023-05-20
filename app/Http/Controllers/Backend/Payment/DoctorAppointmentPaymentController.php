<?php

namespace App\Http\Controllers\Backend\Payment;

use App\Http\Controllers\Controller;
use App\Models\Account\AccountLedger;
use App\Models\Doctor\Doctor;
use App\Models\Doctor\DoctorWithDrawHistory;
use App\Models\Employee\Department;
use App\Models\PaymentSystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DoctorAppointmentPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $history = [];
        $doctor = Doctor::get()->map(function ($doctor) {
            $data['id'] = $doctor->id;
            $data['name'] = $doctor->first_name . ' ' . $doctor->last_name;
            $data['department'] = $doctor->department->name;
            return $data;
        });
        if ($request->doctor_id) {
            $history = Doctor::whereId($request->doctor_id)->with('ledger', 'appointment')->first();
        }
        // dd( $history);
        $department = Department::get()->map(function ($doctor) {
            $data['id'] = $doctor->id;
            $data['name'] = $doctor->name;
            return $data;
        });
        $payment_methods = PaymentSystem::get(['id', 'name']);
        $payment_accounts = AccountLedger::where('rec_pay', true)->get(['id', 'name']);
        return view('backend.payment.doctor.index', compact('doctor', 'department', 'history', 'payment_methods', 'payment_accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doctor = Doctor::whereId($id)->with('ledger')->with(['withdraw' => function ($query) {
            $query->with('paymentMethod', 'paymentLedger');
        }])->first();
        $appointment = Doctor::whereId($id)->with('appointment:id,doctor_id,paid_amount')->first()->appointment;

        return view('backend.payment.doctor.show', compact('doctor', 'appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd( $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $doctor = Doctor::whereId($id)->with('ledger')->first();

        try {
            DB::beginTransaction();
            $doctor->ledger->updateOrCreate(['doctor_id' => $request->doctor_id], [
                'credit' => Str::replace(',', '',  $request->paid_amount)
            ]);
            $withDraw = DoctorWithDrawHistory::create([
                'doctor_id' => $request->doctor_id,
                'amount' => Str::replace(',', '',  $request->paid_amount),
                'ledger_id' => $request->payment_account,
                'payment_method_id' => $request->payment_method,
                'date' => now(),

            ]);

            //<----start of cash flow Transition------->
            // cashflowTransactions
            $cashflowTransition = $withDraw->cashflowTransactions()->create([
                'url'               => "Backend\Payment\DoctorAppointmentPaymentController@show,['id' =>" . $withDraw->id . "]",
                'cashflow_type'     => 'Doctor Payment',
                'description'       => 'Doctor Withdraw Amount',
                'date'              => $withDraw->date,
                'ledger_id'         => $request->payment_account,
                'payment_method'    => $request->payment_method,

            ]);

            // cashflowHistories
            $cashflowTransition->cashflowHistory()->create([
                'credit' => Str::replace(',', '',  $withDraw->amount)
            ]);

            //<----end of cash flow Transition------->

            //<----start of daily book transaction------->
            // dailyTransition
            $dailyTransition = $withDraw->dailyTransactions()->create([
                'url'               => "Backend\Payment\DoctorAppointmentPaymentController@show,['id' =>" . $withDraw->id . "]",
                'description'       => 'Doctor Withdraw Amount',
                'transaction_type'  => 'Doctor Payment',
                'date'              =>  $withDraw->date,
                'reference_no'      =>  $withDraw->id,
            ]);

            // full amount
            $dailyTransition->transactionHistories()->create([
                'entry_name' => 'Doctor Withdraw Amount',
                'credit' => Str::replace(',', '',  $withDraw->amount),
            ]);


            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            dd($ex->getMessage());
        }
        return redirect()->to("admin-payment/doctor-payment?id=".$withDraw->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function invoice(Request $request)
    {
         $doctorWithDrawHistory=DoctorWithDrawHistory::whereId($request->id)->with('paymentMethod', 'doctor')->first();
        return view('backend.payment.doctor.withdrawReceipt', compact('doctorWithDrawHistory'));

    }
}
