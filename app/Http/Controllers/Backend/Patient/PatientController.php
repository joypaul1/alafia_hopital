<?php

namespace App\Http\Controllers\Backend\Patient;

use App\Helpers\InvoiceNumber;
use App\Http\Controllers\Controller;
use App\Models\Patient\Patient;
use App\Models\SiteConfig\BloodBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Dd;
use Yajra\DataTables\Facades\DataTables;


class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->optionData) {
            return response()->json(['data' => Patient::whereLike($request->optionData, 'mobile')
                ->whereLike($request->optionData, 'name')
                ->whereLike($request->optionData, 'patientId')
                ->whereLike($request->optionData, 'email')
                ->take(15)
                ->get()]);
        }
        $status =  (object)[['name' => 'Active', 'id' => 1], ['name' => 'Inactive', 'id' => 0]];

        $patient = Patient::select('*')
            ->latest()->get();
        if (request()->ajax()) {
            return DataTables::of($patient)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                    <a href="' . route('backend.patient.edit', $row->id) . '"
                            data-toggle="tooltip" data-original-title="Edit" class="btn  btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>';
                })
                ->addColumn('action', function ($row) {
                    return '
                    <a href="' . route('backend.patient.edit', $row->id) . '"
                            data-toggle="tooltip" data-original-title="Edit" class="btn btn-sm  btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>';
                })
                ->addColumn('history', function ($row) {
                    return '
                    <a href="' . route('backend.patient.history', $row->id) . '"
                            data-toggle="tooltip" data-original-title="Edit" class="btn btn-sm  btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>';
                })
                // ->editColumn('image', function($row){
                //     return  asset($row->image);
                // })
                // ->editColumn('status', function($row){
                //     return view('components.backend.forms.input.input-switch', ['status' => $row->status ]);

                // })
                ->addColumn('patientId', function ($row) {
                    return $row->patientId;
                })
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->removeColumn(['id'])
                ->rawColumns(['action'])
                ->make(true);
        }
        $patients = Patient::latest()->get();

        return view('backend.patient.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        return view('backend.patient.create', compact(
            'blood_group',
            'genders',
            'marital_status'
        ));
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
            $data['age']                = $request->age;

            $data['blood_group']        = $request->blood_group;
            $data['marital_status']     = $request->marital_status;
            $data['address']            = $request->address;
            $patient = Patient::create($data);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['error' => $ex->getMessage(), 'success' => false, 'status_code' => 400]);
        }

        return response()->json(['success' => 'Patient Created Successfully', 'success' => true, 'status_code' => 200, 'data' => $patient]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        // dd($patient);
        return view('backend.patient.show', compact(
            'patient',
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = Patient::whereId($id)->first();
        //gender option create
        $genders = (object)[
            ['name' => 'male', 'id' => 'male'],
            ['name' => 'female', 'id' => 'female'],
            ['name' => 'others', 'id' => 'others'],
        ];
        //marital_status option create
        $marital_status = (object)[
            ['name' => 'single', 'id' => 'single'],

            ['name' => 'married', 'id' => 'married'],
            ['name' => 'divorced', 'id' => 'divorced'],
            ['name' => 'widowed', 'id' => 'widowed'],

        ];

        //blood group
        $blood_group = BloodBank::where('type_id', 1)->get();
        return view('backend.patient.edit', compact(
            'patient',
            'blood_group',
            'genders',
            'marital_status'
        ));
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
        try {
            // dd($request->all());
            DB::beginTransaction();
            $patient = Patient::whereId($id)->first();

            $patient->name           = $request->name;
            $patient->email              = $request->email;
            $patient->mobile            = $request->mobile;
            $patient->emergency_contact  = $request->emergency_contact;
            $patient->guardian_name      = $request->guardian_name;
            $patient->gender             = $request->gender;
            $patient->dob                = $request->dob;
            $patient->age               = $request->age;

            $patient->blood_group        = $request->blood_group;
            $patient->marital_status     = $request->marital_status;
            $patient->address           = $request->address;
            $patient->save();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            return back()->with(['status' => false, 'error' => 'Patient Not Updated Successfully']);
        }

        return back()->with(['status' => true, 'success' => 'Patient Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Patient::whereId($id)->delete();
        return  response()->json(['status' => true, 'mes' => 'Data Deleted Successfully']);
    }

    public function patientList()
    {
        $status =  (object)[['name' => 'Active', 'id' => 1], ['name' => 'Inactive', 'id' => 0]];

        $patient = Patient::select('*')
            ->latest()->get();
        if (request()->ajax()) {
            return DataTables::of($patient)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action = '
                    <a href="' . route('backend.patient.edit', $row->id) . '"
                            data-toggle="tooltip" data-original-title="Edit" class="btn  btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>


                    ';
                    // $action ='<div class="dropdown">
                    // <button class="btn btn-md dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false" ><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                    //     <div class="dropdown-menu" >
                    //     <a href="'.route('backend.appointment.show', $row).'" class="dropdown-item edit_check"
                    //         data-toggle="tooltip" data-original-title="Show"><i class="fa fa-eye mr-2" aria-hidden="true"></i> Show
                    //     </a>
                    //     <div class="dropdown-divider"></div>
                    //     <a data-href="'.route('backend.appointment.destroy', $row).'"class="dropdown-item delete_check"  data-toggle="tooltip"
                    //         data-original-title="Delete" aria-describedby="tooltip64483"><i class="fa fa-trash mr-2" aria-hidden="true"></i> Delete
                    //     </a>
                    // </div></div>';
                    return $action;
                })
                // ->editColumn('image', function($row){
                //     return  asset($row->image);
                // })
                // ->editColumn('status', function($row){
                //     return view('components.backend.forms.input.input-switch', ['status' => $row->status ]);

                // })
                ->addColumn('patientId', function ($row) {
                    return $row->patientId;
                })
                ->addColumn('name', function ($row) {
                    return $row->name;
                })



                ->removeColumn(['id'])
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.patient.patientlist', compact('status'));
    }

    public function addPatient()
    {
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
        return view('backend.patient.add', compact(
            'blood_group',
            'genders',
            'marital_status'
        ));
    }

    public function savePatient(Request $request)
    {
        try {
            // dd($request->all());
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
            $patient = Patient::create($data);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            return back()->with(['status' => false, 'error' => 'Data Not Added']);
        }

        return back()->with(['status' => true, 'success' => 'Patient Added Successfully']);
    }


    public function history($id)
    {
        Patient::whereId($id)->first();
    }
}
