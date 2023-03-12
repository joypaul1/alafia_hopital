<?php

namespace App\Http\Controllers\Backend\Appointment;

use App\Helpers\Image;
use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Models\Appointment\Appointment;
use App\Models\Doctor\Doctor;
use App\Models\PaymentSystem;
use App\Models\SiteConfig\BloodBank;
use Illuminate\Http\Request;
use App\Http\Requests\Appointment\Doctor\StoreRequest;
use App\Http\Requests\Appointment\Doctor\UpdateRequest;
use App\Models\Employee\Designation;
use FontLib\Table\Type\name;
use Yajra\DataTables\Facades\DataTables;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status =  (object)[['name' => 'Active', 'id' => 1], ['name' => 'Inactive', 'id' => 0]];
        //gender option create
        // $genders = (object)[
        //     ['name' => 'male', 'id' => 'male'],
        //     ['name' => 'female', 'id' => 'female'],
        //     ['name' => 'others', 'id' => 'others'],
        // ];
        //marital_status option create
        // $marital_status = (object)[
        //     ['name' => 'married', 'id' => 'married'],
        //     ['name' => 'unmarried', 'id' => 'unmarried'],
        //     ['name' => 'divorced', 'id' => 'divorced'],
        // ];

        //blood group
        // $blood_group = BloodBank::where('type_id', 1)->get();

        // appointment_priority select option create
        // $appointment_priority = (object)[
        //     ['name' => 'Normal', 'id' => 'Normal'],
        //     ['name' => 'Urgent', 'id' => 'Urgent'],
        // ];


        // $paymentSystems = PaymentSystem::select('id', 'name')->get();

        // //appointment status option create
        // $appointment_status = (object)[
        //     ['name' => 'Approved', 'id' => 'approved'],
        //     ['name' => 'Pending', 'id' => 'pending'],
        // ];

        $appointmentDatas = Appointment::
        select('id', 'invoice_number', 'appointment_date', 'patient_id', 'doctor_id', 'doctor_fee','appointment_status' )
        ->with('patient:id,name,patientId', 'doctor:id,first_name,last_name')->latest()->get();

        if (request()->ajax()) {
            return DataTables::of($appointmentDatas)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action ='<div class="dropdown">
                    <button class="btn btn-md dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false" ><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                        <div class="dropdown-menu" >
                        <a data-href="'.route('backend.appointment.edit', $row).'" class="dropdown-item edit_check"
                            data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit mr-2" aria-hidden="true"></i> Edit
                        </a>
                        <div class="dropdown-divider"></div>
                        <a data-href="'.route('backend.appointment.destroy', $row).'"class="dropdown-item delete_check"  data-toggle="tooltip"
                            data-original-title="Delete" aria-describedby="tooltip64483"><i class="fa fa-trash mr-2" aria-hidden="true"></i> Delete
                        </a>
                    </div></div>';
                    return $action;
                })
                // ->editColumn('image', function($row){
                //     return  asset($row->image);
                // })
                // ->editColumn('status', function($row){
                //     return view('components.backend.forms.input.input-switch', ['status' => $row->status ]);

                // })
                ->editColumn('appointment_date', function($row) {
                    return date('d-m-Y', strtotime($row->appointment_date));
                })
                ->editColumn('patient_id', function($row) {
                    return optional($row->patient)->name ;
                })
                ->editColumn('doctor_id', function($row) {
                    return optional($row->doctor)->first_name;
                })
                ->editColumn('doctor_fee', function($row) {
                    return  number_format($row->doctor_fee, 2);
                })
                ->addColumn('paymentHistories', function($row) {
                    return implode(' ,', $row->paymentHistories()->pluck('payment_method')->toArray());
                })
                ->removeColumn(['id'])
                ->rawColumns(['action', 'paymentHistories'])
                ->make(true);

        }
        return view('backend.appointment.doctor.index',
            compact(
                'appointmentDatas'
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
        $appointment_status = (object)[
            ['name' => 'Approved', 'id' => 'approved'],
            ['name' => 'Pending', 'id' => 'pending'],
        ];

        $doctors = Doctor::active()->select('id', 'first_name', 'last_name')->get()->map(function ($doctor) {
            $data['id'] = $doctor->id;
            $data['name'] = $doctor->first_name . ' ' . $doctor->last_name;
            return $data;
        });
        $designation = Designation::active()->select('id', 'name')->get();

        return view('backend.appointment.doctor.create', compact(
            'doctors',
            'designation',
            'appointment_status',
            'appointment_priority',
            'paymentSystems'
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
        // dd($request->all());
        $returnData = $request->storeData($request);
        // dd(  $returnData );
        if ($returnData->getData()->status) {
            (new LogActivity)::addToLog('Appointment Created');
            return redirect()->route('backend.appointment.show', $returnData->getData()->data);
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
        $appointment = Appointment::whereId($id)->with('doctor', 'patient', 'paymentHistories')->first();
        return view('backend.appointment.moneyReceipt', compact('appointment'));
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
            // (new Image)->deleteIfExists($category->image);
            $appointment->delete();

        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'mes' =>$ex->getMessage()]);
        }
        (new LogActivity)::addToLog('Category Deleted');
        return  response()->json(['status' => true, 'mes' => 'Data Deleted Successfully']);
    }
}
