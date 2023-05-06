<?php

namespace App\Http\Controllers\Backend\Pos;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Models\Pos\Outlet;
use App\Models\Pos\Register;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Pos\Register\StoreRequest;
use App\Http\Requests\Pos\Register\UpdateRequest;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data =Register::select('id','name','status', 'outlet_id')
        ->with('outlet:id,name')
        ->when($request->country_id, function($query) use ($request){
            $query->whereCountryId($request->country_id);
        })
        ->latest();

        if($request->status){
            $data = $data->active();
        }elseif($request->status == false){
            $data = $data->inactive();
        }
        $data = $data->get();
        // $data = $data->where('status', $request->status?1)->get();

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action ='<div class="dropdown">
                    <button class="btn btn-md dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false" ><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                        <div class="dropdown-menu">
                        <a href="'.route('backend.register.edit', $row).'" class="dropdown-item"
                            data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit mr-2" aria-hidden="true"></i> Edit
                        </a>
                        <div class="dropdown-divider"></div>
                        <a data-href="'.route('backend.register.destroy', $row).'"class="dropdown-item delete_check"  data-toggle="tooltip"
                            data-original-title="Delete" aria-describedby="tooltip64483"><i class="fa fa-trash mr-2" aria-hidden="true"></i> Delete
                        </a>
                    </div></div>';
                    return   $action;
                })
                ->editColumn('outlet_id', function($row){
                    return optional($row->outlet)->name;
                })
                ->editColumn('status', function($row){
                    return view('components.backend.forms.input.input-switch', ['status' => $row->status ]);
                })
                ->removeColumn(['id'])
                ->rawColumns(['action'])
                ->make(true);

        }
        $status=  (object)[['name' =>'Active', 'id' =>1 ],['name' =>'Inactive', 'id' => 0 ]];
        return view('backend.pos.register.index', compact('status'))->with([ 'outlets' =>  Outlet::get(['name', 'id'])]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('backend.pos.register.create')->with(['outlets' =>  Outlet::get(['name', 'id'])]);
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
        if($returnData->getData()->status){
            (new LogActivity)::addToLog('Register Created');
            return response()->json(['success' =>$returnData->getData()->msg, 'status' =>true], 200) ;
        }
        return response()->json(['error' =>$returnData->getData()->msg,'status' =>false], 400) ;

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
    public function destroy(Register $register)
    {
        try {
            $register->delete();
        } catch (\Exception $ex) {
            return back()->with(['status' => false, 'mes' =>$ex->getMessage()]);
        }
        return  response()->json(['status' => true, 'mes' => 'Data Deleted Successfully']);
    }
}
