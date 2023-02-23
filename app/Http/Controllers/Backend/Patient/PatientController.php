<?php

namespace App\Http\Controllers\Backend\Patient;

use App\Helpers\InvoiceNumber;
use App\Http\Controllers\Controller;
use App\Models\Patient\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->optionData){
            return response()->json(['data' => Patient::
            // where('name', 'LIKE', "%{$request->optionData}%")->
            whereLike($request->optionData, 'mobile')->
            whereLike($request->optionData, 'name')->
            whereLike($request->optionData, 'patientId')->
            whereLike($request->optionData, 'email')->
            take(15)
            ->get()]);
        }

        return view('backend.patient.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.patient.create');
    }

    public function getInvoiceNumber()
    {
        if (!Patient::latest()->first()) {
            return 1;
        } else {
            return Patient::latest()->first()->patientId + 1;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data['patientId']          = (new InvoiceNumber)->invoice_num($this->getInvoiceNumber());
            $data['name']               = $request->name;
            $data['email']              = $request->email;
            $data['mobile']             = $request->mobile;
            $data['emergency_contact']  = $request->emergency_contact;
            $data['guardian_name']      = $request->guardian_name;
            $data['gender']             = $request->gender;
            $data['dob']                = $request->dob;
            $data['blood_group']        = $request->blood_group;
            $data['marital_status']     = $request->marital_status;
            $data['address']            = $request->address;
            $patient =Patient::create($data);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            return back()->with('error',  $ex->getMessage());
        }
            return back()->with('success', 'Patient Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
