<?php

namespace App\Http\Controllers\Backend\Doctor;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Models\Doctor\Doctor;
use App\Models\Employee\Department;
use App\Models\Employee\Designation;
use App\Models\Employee\Shift;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\Doctor\StoreRequest;
use App\Models\Doctor\DoctorAppointmentSchedule;
use Yajra\DataTables\Facades\DataTables;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status=  (object)[['name' =>'Active', 'id' =>1 ],['name' =>'Inactive', 'id' => 0 ]];

        if($request->optionData) {
            $data = Doctor::latest()->get();
            return response()->json(['data' =>$data]);
        }
        if($request->designation_id) {
            $data = Doctor::active()->where('designation_id', $request->designation_id)->select('id', 'first_name', 'last_name')->get()->map(function ($doctor) {
                $data['id'] = $doctor->id;
                $data['name'] = $doctor->first_name . ' ' . $doctor->last_name;
                return $data;
            });;
            return response()->json(['data' =>$data]);
        }
        if($request->department_id) {
            $data = Doctor::active()->where('department_id', $request->department_id)->select('id', 'first_name', 'last_name')->get()->map(function ($doctor) {
                $data['id'] = $doctor->id;
                $data['name'] = $doctor->first_name . ' ' . $doctor->last_name;
                return $data;
            });;
            return response()->json(['data' =>$data]);
        }
        if (request()->ajax()) {
            $data = Doctor::latest();
            if($request->status){
                $data = $data->active();
            }elseif($request->status == '0'){
                $data = $data->inactive();
            }
            $data = $data->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action ='<div class="dropdown">
                    <button class="btn btn-md dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false" ><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                        <div class="dropdown-menu" >
                        <a data-href="'.route('backend.doctor.edit', $row).'" class="dropdown-item edit_check"
                            data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit mr-2" aria-hidden="true"></i> Edit
                        </a>
                        <div class="dropdown-divider"></div>
                        <a data-href="'.route('backend.doctor.destroy', $row).'"class="dropdown-item delete_check"  data-toggle="tooltip"
                            data-original-title="Delete" aria-describedby="tooltip64483"><i class="fa fa-trash mr-2" aria-hidden="true"></i> Delete
                        </a>
                    </div></div>';
                    return $action;
                })
                ->editColumn('image', function($row){
                    return  asset($row->image);
                })
                ->editColumn('status', function($row){
                    return view('components.backend.forms.input.input-switch', ['status' => $row->status ]);
                })
                ->editColumn('department_id', function($row){
                    return optional($row->department)->name??' ';
                })
                ->editColumn('designation_id', function($row){
                    return optional($row->designation)->name??' ';
                })
                ->addColumn('full_name', function($row){
                    return $row->first_name.' '.$row->last_name;
                })
                ->removeColumn(['id'])
                ->rawColumns(['action'])
                ->make(true);

        }

        return view('backend.doctor.home.index', compact( 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors        = Doctor::select('id', 'first_name')->get();
        $status         =  (object)[['name' =>'Active', 'id' =>1 ],['name' =>'Inactive', 'id' => 0 ]];
        $departments    = Department::select('id', 'name')->get();
        $designations   = Designation::select('id', 'name')->get();
        $roles          = Role::select('id', 'name')->get();
        $shifts         = Shift::select('id', 'name')->get();
        return view('backend.doctor.home.create', compact('doctors', 'status',
         'departments', 'designations', 'roles', 'shifts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        // dd($request->storeRequest());
        $returnData = $request->storeData($request);
        if($returnData->getData()->status){
            (new LogActivity)::addToLog('Doctor Created');
            return back()->with('success' , $returnData->getData()->msg) ;
        }
        return back()->with('error' , $returnData->getData()->msg) ;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (request()->slot) {
            $timeSlot = [];
            $data = Doctor::whereId($id)->select('id')
            ->with('doctorAppointmentSchedules')
            ->first();
            //php date wise day show
            $day = date('l', strtotime(request()->date));
            $timeSlot = $data->doctorAppointmentSchedules()->where('day', $day)->get()->map(function($query){
                return [
                    'start_time' => date("h.i A", strtotime($query->start_time)),
                    'end_time' => date("h.i A", strtotime($query->end_time)),
                    'id'    => $query->id,
                ];
            });
            return response()->json(['data'=> $timeSlot]);

        }
        // get ajax request for single data show
        if (request()->ajax()) {
            $data = Doctor::whereId($id)->select('id')->with('consultations:id,doctor_id,consultation_day,consultation_fee')
            ->first();
            $consultation_fee= $data->consultations->first()->consultation_fee ;
            return response()->json($consultation_fee);
        }


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
