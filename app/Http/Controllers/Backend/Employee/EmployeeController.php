<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Helpers\Image;
use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\StoreRequest;
use App\Http\Requests\Employee\UpdateRequest;
use App\Models\Employee\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth('admin')->user()->can('view-employee')){

        $employees = Employee::get();
        return view('backend.employee.home.index', compact('employees'));
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
        if(auth('admin')->user()->can('create-employee')){

        return view('backend.employee.home.create');
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
        if(auth('admin')->user()->can('edit-employee')){

        return view('backend.employee.edit',compact('employee'));
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
        if(auth('admin')->user()->can('delete-employee')){

        try {
            (new Image)->deleteIfExists($employee->image);
            $employee->delete();
        } catch (\Exception $ex) {
            return back()->with(['status' => false, 'error' =>$ex->getMessage()]);
        }
		(new LogActivity)::addToLog('Employee Deleted');
        return back()->with(['status' => true, 'success' => 'Data Deleted Successfully']);
    }
    abort(403, 'Unauthorized action.');

}
}
