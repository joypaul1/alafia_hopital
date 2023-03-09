<?php

namespace App\Http\Controllers\Backend\Appointment;
use App\Helpers\LogActivity;
use App\Helpers\NumbertoWordsConvertor;
use App\Models\Appointment\Appointment;
use App\Models\PaymentSystem;
use App\Models\SiteConfig\BloodBank;
use Illuminate\Http\Request;
use App\Http\Requests\Appointment\Dialysis\StoreRequest;
use App\Http\Requests\Appointment\Dialysis\UpdateRequest;
use App\Http\Controllers\Controller;
use App\Models\Appointment\DialysisAppointment;
use App\Models\Employee\Employee;

class DialysisAppointmentController extends Controller
{
    // use ConvertNumber;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return NumtoWordCon::convertor(1232);
        $status =  (object)[['name' => 'Active', 'id' => 1], ['name' => 'Inactive', 'id' => 0]];
        //gender option create
        $genders = (object)[
            ['name' => 'male', 'id' => 'male'],
            ['name' => 'female', 'id' => 'female'],
            ['name' => 'others', 'id' => 'others'],
        ];
        //marital_status option create
        $marital_status = (object)[
            ['name' => 'married', 'id' => 'married'],
            ['name' => 'unmarried', 'id' => 'unmarried'],
            ['name' => 'divorced', 'id' => 'divorced'],
        ];

        //blood group
        $blood_group = BloodBank::where('type_id', 1)->get();

        // appointment_priority select option create
        $appointment_priority = (object)[
            ['name' => 'Normal', 'id' => 'Normal'],
            ['name' => 'Urgent', 'id' => 'Urgent'],
        ];

        $employees = Employee::select('id', 'name')->get();

        $paymentSystems = PaymentSystem::select('id', 'name')->get();

        //appointment status option create
        $appointment_status = (object)[
            ['name' => 'Approved', 'id' => 'approved'],
            ['name' => 'Pending', 'id' => 'pending'],
        ];
        $appointment_schedule = (object)[
            ['name' => '8am-12am', 'id' => '8am-12am'],
            ['name' => '1pm-4pm', 'id' => '1pm-4pm'],
            ['name' => '6pm-10pm', 'id' => '6pm-10pm'],
        ];

        $appointmentDatas = Appointment::with('patient', 'doctor')->latest()->get();
        return view('backend.appointment.dialysis.index',compact(
                'blood_group',
                'genders',
                'marital_status',
                'appointment_status',
                'appointmentDatas',
                'appointment_priority',
                'employees',
                'paymentSystems',
                'appointment_schedule'
            )
        );
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.appointment.dialysis.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        // dd($request->all(),AccountLedger::first());
        $returnData = $request->storeData($request);
        // dd(  $returnData );
        if ($returnData->getData()->status) {
            (new LogActivity)::addToLog('Appointment Created');
            return redirect()->route('backend.dialysis-appointment.show', $returnData->getData()->data);
            // $this->moneyReceipt($returnData->getData()->data);
            // return back()->with('success', $returnData->getData()->msg);
            // return redirect()->to('admin/appointment/money-receipt',  $returnData->getData()->data);
            // return redirect(route("backend.appointment.moneyReceipt")."?id=".$returnData->getData()->data);
            // return redirect()->route('admin/appointment/money-receipt',  $returnData->getData()->data);
            // ->with('success', $returnData->getData()->msg);
            // return response()->json(['success' =>$returnData->getData()->msg, 'status' =>true], 200) ;
        }
        return back()->with('error', $returnData->getData()->msg);
        // return response()->json(['error' =>$returnData->getData()->msg,'status' =>false], 400) ;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appointment = DialysisAppointment::whereId($id)->with('asignEmp', 'patient', 'paymentHistories')->first();
        return view('backend.appointment.dialysis.moneyReceipt', compact('appointment'));
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
