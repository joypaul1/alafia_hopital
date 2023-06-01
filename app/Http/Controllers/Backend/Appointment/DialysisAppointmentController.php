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
use App\Models\Doctor\Doctor;
use App\Models\Employee\Employee;
use App\Models\Service\ServiceInvoice;

class DialysisAppointmentController extends Controller
{
    // use ConvertNumber;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
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
        $doctors = Doctor::select('id', 'first_name', 'last_name')->get()->map(function ($query) {
            $data['id'] = $query->id;
            $data['name'] = $query->first_name . ' ' . $query->last_name;
            return $data;
        });

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
        $discountType = (object)[
            ['name' => 'Fixed', 'id' => 'fixed'],
            ['name' => 'Percentage', 'id' => 'percentage'],
        ];
        $appointmentData = DialysisAppointment::query();

        if ($request->patient_id) {
            $appointmentData = $appointmentData->whereHas('patient', function ($query) use ($request) {
                return $query->Where('patientId', 'like', "%{$request->patient_id}%");
            });
        }
        if ($request->mobile_number) {
            $appointmentData = $appointmentData->whereHas('patient', function ($query) use ($request) {
                return $query->Where('mobile', 'like', "%{$request->mobile_number}%");
            });
        }
        if ($request->patient_name) {
            $appointmentData = $appointmentData->whereHas('patient', function ($query) use ($request) {
                return $query->Where('name', 'like', "%{$request->patient_name}%");
            });
        }
        if ($request->invoice_no) {
            $appointmentData = $appointmentData->where('invoice_number', $request->invoice_no);
        }
        if ($request->start_date) {
            $appointmentData = $appointmentData->whereDate('date', '>=', date('Y-m-d', strtotime($request->start_date)));
        } else {
            $appointmentData = $appointmentData->whereDate('date', '>=', date('Y-m-d'));
        }
        if ($request->end_date) {
            $appointmentData = $appointmentData->whereDate('date', '<=',  date('Y-m-d', strtotime($request->end_date)));
        } else {
            $appointmentData = $appointmentData->whereDate('date', '>=', date('Y-m-d'));
        }
        $appointmentData=$appointmentData->with('patient', 'doctor')->get();
        return view('backend.appointment.dialysis.index',
            compact(
                'blood_group',
                'genders',
                'marital_status',
                'appointment_status',
                'appointmentData',
                'appointment_priority',
                'employees',
                'paymentSystems',
                'appointment_schedule',
                'doctors',
                'discountType'
            )
        );
    }


    public function serviceInvoice(Request $request)
    {
        $serviceInvoice = ServiceInvoice::whereId($request->id)->with('itemDetails.serviceName', 'patient', 'paymentHistories')->first();
        return view('backend.appointment.dialysis.service-invoice', compact('serviceInvoice'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //appointment status option create
        $discountType = (object)[
            ['name' => 'Fixed', 'id' => 'fixed'],
            ['name' => 'Percentage', 'id' => 'percentage'],
        ];
        return view('backend.appointment.dialysis.create', compact('discountType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {

        $returnData = $request->storeData($request);
        if ($returnData->getData()->status) {
            (new LogActivity)::addToLog('Appointment Created');
            return redirect()->route('backend.dialysis-appointment.show', $returnData->getData()->data);
        }
        return back()->with('error', $returnData->getData()->msg);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appointment = DialysisAppointment::whereId($id)->with('assignEmp', 'patient', 'paymentHistories')->first();
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
