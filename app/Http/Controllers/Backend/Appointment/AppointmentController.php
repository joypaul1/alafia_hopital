<?php

namespace App\Http\Controllers\Backend\Appointment;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Models\Appointment\Appointment;
use App\Models\Doctor\Doctor;
use App\Models\PaymentSystem;
use Illuminate\Http\Request;
use App\Http\Requests\Appointment\Doctor\StoreRequest;
use App\Models\Employee\Department;
use Yajra\DataTables\Facades\DataTables;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $appointmentData = Appointment::query();
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
        $appointmentData = $appointmentData->select('id', 'invoice_number', 'appointment_date', 'patient_id', 'doctor_id', 'doctor_fee', 'appointment_status', 'visitType')
            ->with('patient:id,name,patientId', 'doctor:id,first_name,last_name')->latest()->get();

        if (request()->ajax()) {
            return DataTables::of($appointmentData)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action = '<div class="dropdown">
                    <button class="btn btn-md dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false" ><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>

                    <div class="dropdown-menu" >
                        <a href="' . route('backend.appointment.prescription', $row) . '"class="dropdown-item"  target="_blank" data-toggle="tooltip"
                            data-original-title="prescription Pad" aria-describedby="tooltip64483"><i class="fa fa-hospital-o mr-2" aria-hidden="true"></i> Pad
                        </a>
                        <div class="dropdown-divider"></div>

                        <a href="' . route('backend.appointment.show', $row) . '" class="dropdown-item edit_check"
                            data-toggle="tooltip" data-original-title="Show"><i class="fa fa-eye mr-2" aria-hidden="true"></i> Show
                        </a>
                        <div class="dropdown-divider"></div>

                        <a data-href="' . route('backend.appointment.destroy', $row) . '"class="dropdown-item delete_check"  data-toggle="tooltip"
                            data-original-title="Delete" aria-describedby="tooltip64483"><i class="fa fa-trash mr-2" aria-hidden="true"></i> Delete
                        </a>
                    </div>';
                    return $action;
                })

                ->editColumn('appointment_date', function ($row) {
                    return date('d-m-Y', strtotime($row->appointment_date));
                })
                ->editColumn('patient_id', function ($row) {
                    return optional($row->patient)->name;
                })
                ->editColumn('doctor_id', function ($row) {
                    return optional($row->doctor)->first_name;
                })
                ->editColumn('doctor_fee', function ($row) {
                    return  number_format($row->doctor_fee, 2);
                })
                ->addColumn('paymentHistories', function ($row) {
                    return implode(' ,', $row->paymentHistories()->pluck('payment_method')->toArray());
                })
                ->removeColumn(['id'])
                ->rawColumns(['action', 'paymentHistories'])
                ->make(true);
        }
        return view('backend.appointment.doctor.index');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $appointment_priority = (object)[
            ['name' => 'Normal', 'id' => 'Normal'],
            ['name' => 'Urgent', 'id' => 'Urgent'],
        ];

        $paymentSystems = PaymentSystem::select('id', 'name')->get();

        //appointment status option create
        $appointment_status = (object)[
            ['name' => 'Approved', 'id' => 'approved'],
            ['name' => 'Pending', 'id' => 'pending'],
        ];

        $paymentSystems = PaymentSystem::select('id', 'name')->get();


        //appointment status option create
        $discountType = (object)[
            ['name' => 'Fixed', 'id' => 'fixed'],
            ['name' => 'Percentage', 'id' => 'percentage'],
        ];

        $doctors = Doctor::active()->select('id', 'first_name', 'last_name')->get()->map(function ($doctor) {
            $data['id'] = $doctor->id;
            $data['name'] = $doctor->first_name . ' ' . $doctor->last_name;
            return $data;
        });
        $department = Department::active()->select('id', 'name')->get();

        return view('backend.appointment.doctor.create', compact(
            'doctors',
            'department',
            'appointment_status',
            'appointment_priority',
            'paymentSystems',
            'discountType'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $returnData = $request->storeData();
        if ($returnData->getData()->status) {
            (new LogActivity)::addToLog('Appointment Created');
            return redirect()->route('backend.appointment.show', $returnData->getData()->data);
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
        $appointment = Appointment::whereId($id)->with('doctor', 'patient', 'paymentHistories')->first();
        return view('backend.appointment.doctor.moneyReceipt', compact('appointment'));
    }
    public function prescriptionPad($id)
    {
        $appointment = Appointment::whereId($id)->with('doctor', 'patient')->first();
        return view('backend.appointment.doctor.prescriptionPad', compact('appointment'));
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
    public function destroy(Appointment $appointment)
    {
        try {
            $appointment->delete();
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'mes' => $ex->getMessage()]);
        }
        (new LogActivity)::addToLog('Category Deleted');
        return  response()->json(['status' => true, 'mes' => 'Data Deleted Successfully']);
    }

    public function getSerialNumber($request)
    {
        $lastSerialNumber = Appointment::where('doctor_id', $request->doctorID)
            ->where('appointment_date', $request->appointment_date)
            ->where('doctor_appointment_schedule_id', $request->appointment_schedule)
            ->max('serial_number');
        return $lastSerialNumber ? $lastSerialNumber + 1 : 1;
    }
}
