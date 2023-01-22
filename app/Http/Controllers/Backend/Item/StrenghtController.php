<?php

namespace App\Http\Controllers\Backend\Item;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Models\Item\Strenght;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Strenght\StoreRequest;
use App\Http\Requests\Strenght\UpdateRequest;

class StrenghtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Strenght::select(['id', 'name', 'note', 'status'])->latest();
        if($request->status == '1'){ 
            $data = $data->active();
        }elseif($request->status == '0'){
            $data = $data->inactive();
        }
        
        $data = $data->get();
        
        if (request()->ajax()) {
        
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action ='<div class="dropdown">
                    <button class="btn btn-md dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false" ><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                        <div class="dropdown-menu">
                        <a data-href="'.route('backend.itemconfig.strenght.edit', $row).'" class="dropdown-item edit_check"
                            data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit mr-2" aria-hidden="true"></i> Edit
                        </a>
                        <div class="dropdown-divider"></div>
                        <a data-href="'.route('backend.itemconfig.strenght.destroy', $row).'"class="dropdown-item delete_check"  data-toggle="tooltip" 
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
                ->removeColumn(['id'])
                ->rawColumns(['action'])
                ->make(true);
          
        }
        $status=  (object)[['name' =>'Active', 'id' =>1 ],['name' =>'Inactive', 'id' => 0 ]];
        return view('backend.item.strenght.index', compact('status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.item.strenght.create');
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
            (new LogActivity)::addToLog('strenght Created');
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
    public function edit(Strenght $strenght )
    {
        return view('backend.item.strenght.edit',compact('strenght'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Strenght $strenght)
    {
        $returnData = $request->updateData($strenght);
        if($returnData->getData()->status){
            (new LogActivity)::addToLog('strenght Updated');
            return response()->json(['success' =>$returnData->getData()->msg, 'status' =>true], 200) ;
        }
        return response()->json(['error' =>$returnData->getData()->msg,'status' =>false], 400) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Strenght $strenght)
    {
        try {
            $strenght->delete();
        } catch (\Exception $ex) {
            return back()->with(['status' => false, 'error' =>$ex->getMessage()]);
        }
        (new LogActivity)::addToLog('strenght Deleted');

        return back()->with(['status' => true, 'success' => 'Data Deleted Successfully']);   
    }
}
