<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\Employee\Shift\StoreRequest;
use App\Http\Requests\Employee\Shift\UpdateRequest;
use App\Models\Employee\Shift;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shifts = Shift::select('id', 'name', 'status', 'start_time', 'end_time')->paginate(10);
        return view('backend.employee.shift.index', compact('shifts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.employee.shift.create');
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
        if($returnData->getData()->status){
            (new LogActivity)::addToLog('Shift Created');
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
    public function edit(Shift $shift )
    {
        return view('backend.employee.shift.edit',compact('shift'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Shift $shift)
    {
        $returnData = $request->updateData($request, $shift);
        if($returnData->getData()->status){
            (new LogActivity)::addToLog('Shift Updated');
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
    public function destroy(Shift $shift)
    {
        try {
            $shift->delete();
        } catch (\Exception $ex) {
            return back()->with(['status' => false, 'error' =>$ex->getMessage()]);
        }
        (new LogActivity)::addToLog('Shift Deleted');

        return back()->with(['status' => true, 'success' => 'Data Deleted Successfully']);   
    }
}
