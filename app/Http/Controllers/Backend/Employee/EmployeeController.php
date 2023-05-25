<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Helpers\Image;
use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\StoreRequest;
use App\Http\Requests\Employee\UpdateRequest;
use App\Models\Employee\Employee;
use App\Models\Employee\Department;
use App\Models\Employee\Designation;
use App\Models\Employee\Shift;
use App\Models\Role;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status =  (object)[['name' => 'Active', 'id' => 1], ['name' => 'Inactive', 'id' => 0]];

        $appointmentData = Employee::select('*')
            ->latest()->get();
        if (request()->ajax()) {
            return DataTables::of($appointmentData)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action = '
                    <a href="' . route('backend.employee.edit', $row->id) . '"
                            data-toggle="tooltip" data-original-title="Edit" class="btn  btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                        <a data-href="'.route('backend.employee.destroy', $row->id).'" class="btn btn-danger delete_check" data-toggle="tooltip" data-original-title="Delete" aria-describedby="tooltip64483">
                            <i class="fa fa-trash " aria-hidden="true"></i> 
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
                ->addColumn('Employee', function ($row) {
                    return $row->name;
                })
             


                ->removeColumn(['id'])
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.employee.home.index', compact('status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status         =  (object)[['name' => 'Active', 'id' => 1], ['name' => 'Inactive', 'id' => 0]];
        $departments    = Department::select('id', 'name')->get();
        $designations   = Designation::select('id', 'name')->get();
        $roles          = Role::select('id', 'name')->get();
        $shifts         = Shift::select('id', 'name')->get();
        return view('backend.employee.home.create',compact('status',
        'departments',
        'designations',
        'roles',
        'shifts'));
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
        if($returnData->getData()->status){
		    (new LogActivity)::addToLog('Employee Created');
            return back()->with(['success' => $returnData->getData()->msg  ]);
        }
        return back()->with(['error' =>$returnData->getData()->msg ]);

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
    public function edit(Employee $employee )
    {
        $status         =  (object)[['name' => 'Active', 'id' => 1], ['name' => 'Inactive', 'id' => 0]];
        $departments    = Department::select('id', 'name')->get();
        $designations   = Designation::select('id', 'name')->get();
        $roles          = Role::select('id', 'name')->get();
        $shifts         = Shift::select('id', 'name')->get();

        return view('backend.doctor.home.edit', compact(
            'employee',
            'status',
            'departments',
            'designations',
            'roles',
            'shifts'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Employee $employee)
    {

        $returnData = $request->updateData($request, $employee);
        if($returnData->getData()->status){
		    (new LogActivity)::addToLog('Employee Updated');
            return back()->with(['success' => $returnData->getData()->msg  ]);
        }
        return back()->with(['error' =>$returnData->getData()->msg ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        try {
            (new Image)->deleteIfExists($employee->image);
            $employee->delete();
        } catch (\Exception $ex) {
            return back()->with(['status' => false, 'error' =>$ex->getMessage()]);
        }
		(new LogActivity)::addToLog('Employee Deleted');
        return back()->with(['status' => true, 'success' => 'Data Deleted Successfully']);
    }
}
