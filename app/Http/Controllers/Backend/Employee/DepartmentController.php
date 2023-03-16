<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\Department\StoreRequest;
use App\Http\Requests\Employee\Department\UpdateRequest;
use App\Models\Employee\Department;
use App\Models\Employee\Designation;

class DepartmentController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth('admin')->user()->can('view-department')){

        $departments = Department::select('id', 'name', 'status', 'created_by')->with('createdBy')->with(['designations' => function($query){
            $query->select('designation_id', 'name');
        }])->orderBy('id', 'DESC')->paginate(20);
        return view('backend.employee.department.index', compact('departments'));
    }
    abort(403, 'Unauthorized action.');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth('admin')->user()->can('create-department')){

        $designations = Designation::select('id', 'name')->get();
        return view('backend.employee.department.create', compact('designations'));
        }
        abort(403, 'Unauthorized action.');

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
            (new LogActivity)::addToLog('Department Created');
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
    public function edit(Department $department )
    {
        if(auth('admin')->user()->can('edit-department')){

        $designations = Designation::select('id', 'name')->get();
        return view('backend.employee.department.edit',compact('department', 'designations'));
    }
    abort(403, 'Unauthorized action.');

}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request,Department $department )
    {
        $returnData = $request->updateData($request, $department);
        if($returnData->getData()->status){
            (new LogActivity)::addToLog('Department Updated');
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
    public function destroy(Department $department)
    {
        if(auth('admin')->user()->can('delete-department')){

        try {
            $department->delete();
        } catch (\Exception $ex) {
            return back()->with(['status' => false, 'error' =>$ex->getMessage()]);
        }
        (new LogActivity)::addToLog('Department Deleted');

        return back()->with(['status' => true, 'success' => 'Data Deleted Successfully']);
    }
    abort(403, 'Unauthorized action.');

}
}

