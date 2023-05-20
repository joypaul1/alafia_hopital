<?php

namespace App\Http\Controllers\Backend\Payment;

use App\Http\Controllers\Controller;
use App\Models\Doctor\Doctor;
use App\Models\Employee\Department;
use Illuminate\Http\Request;

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
        if($request->doctor_id){
            $history = Doctor::whereId($request->doctor_id)->with('ledger', 'appointment')->first();
        }
        // dd( $history);
        $department = Department::get()->map(function ($doctor) {
            $data['id'] = $doctor->id;
            $data['name'] = $doctor->name;
            return $data;
        });
        return view('backend.payment.doctor.index', compact('doctor', 'department', 'history'));
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
        $doctor = Doctor::whereId($id)->with('ledger')->with(['withdraw' => function($query){
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
        //
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
        //
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
}
