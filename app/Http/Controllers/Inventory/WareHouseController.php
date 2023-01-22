<?php

namespace App\Http\Controllers\Inventory;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Models\Inventory\WareHouse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Inventory\Warehouse\StoreRequest;
use App\Http\Requests\Inventory\Warehouse\UpdateRequest;
use App\Models\Country;

class WareHouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    
        $data = WareHouse::select(['id','name','mobile', 'email','status', 'city','province','country_id'])
        ->when($request->country_id, function($qeury) use ($request){
            $qeury->whereCountryId($request->country_id);
        })->latest();

        if($request->optionData){
            return response()->json(['data' => $data->active()->get()]);
        }
        if($request->status){ 
            $data = $data->active();
        }elseif($request->status == '0'){
            $data = $data->inactive();
        }
        
        $data = $data->get();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                  
                    $action ='<div class="dropdown">
                    <button class="btn btn-md dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false" ><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                        <div class="dropdown-menu">
                        <a href="'.route('backend.inventory.warehouse.edit', $row).'" class="dropdown-item"
                            data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit mr-2" aria-hidden="true"></i> Edit
                        </a>
                        <div class="dropdown-divider"></div>
                        <a data-href="'.route('backend.inventory.warehouse.destroy', $row).'"class="dropdown-item delete_check"  data-toggle="tooltip" 
                            data-original-title="Delete" aria-describedby="tooltip64483"><i class="fa fa-trash mr-2" aria-hidden="true"></i> Delete
                        </a>
                    </div></div>';
                    return $action;
                })
                ->editColumn('status', function($row){
                    return view('components.backend.forms.input.input-switch', ['status' => $row->status ]);
                })
                ->editColumn('country_id', function($row){
                    return optional($row->country)->name;
                })
                ->removeColumn(['id'])
                ->rawColumns(['action'])
                ->make(true);
              
        }
        $status=  (object)[['name' =>'Active', 'id' =>1 ],['name' =>'Inactive', 'id' => 0 ]];

        return view('backend.inventory.warehouse.index', compact('status'))
        ->with([ 'countries' =>  Country::get(['name', 'id'])]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('backend.inventory.warehouse.create')->with(['countries' =>  Country::get(['name', 'id'])]);
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
            (new LogActivity)::addToLog('Supplier Created');
            return response()->json(['mes' =>$returnData->getData()->msg, 'status' =>true], 200) ;
        }
        return response()->json(['mes' =>$returnData->getData()->msg,'status' =>false], 400) ;
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
        dd($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(WareHouse $warehouse)
    {
        try {
            $warehouse->delete();
        } catch (\Exception $ex) {
            return back()->with(['status' => false, 'mes' =>$ex->getMessage()]);
        }
        return  response()->json(['status' => true, 'mes' => 'Data Deleted Successfully']);   
    }
}

