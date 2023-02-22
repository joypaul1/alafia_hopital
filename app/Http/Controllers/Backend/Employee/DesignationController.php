<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\Designation\StoreRequest;
use App\Http\Requests\Employee\Designation\UpdateRequest;
use App\Models\Employee\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $designations = Designation::select('id', 'name','status')->paginate(20);
        return view('backend.employee.designation.index', compact('designations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.employee.designation.create');
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
            (new LogActivity)::addToLog('Designation Created');
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
        // single value show for ajax request
        $designation = Designation::select('id', 'name',)->where('id',$id)->first();
        return response()->json($designation);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Designation $designation )
    {
        return view('backend.employee.designation.edit',compact('designation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request,Designation $designation)
    {
        $returnData = $request->updateData($request, $designation);
        if($returnData->getData()->status){
            (new LogActivity)::addToLog('Designation Updated');
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
    public function destroy(Designation $designation)
    {
        try {
            // (new Image)->deleteIfExists($category->image);
            $designation->delete();
        } catch (\Exception $ex) {
            return back()->with(['status' => false, 'error' =>$ex->getMessage()]);
        }
        (new LogActivity)::addToLog('Designation Deleted');

        return back()->with(['status' => true, 'success' => 'Data Deleted Successfully']);
    }
}
