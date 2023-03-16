<?php

namespace App\Http\Controllers\Backend\Item;

use App\Http\Controllers\Controller;
use App\Models\Item\Row;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Item\Row\StoreRequest;
use App\Http\Requests\Item\Row\UpdateRequest;
use App\Models\Item\Rack;

class RowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(auth('admin')->user()->can('view-row')){

        
        if ($request->rack_id) {
          
            $data = Row::active()->whereRackId($request->rack_id)->select(['id','name','rack_id'])->latest()->get();
            return response()->json(['data' => $data]);
        }
        if (($request->rack_id !=null) && $request->ajax()) {
            $data = Row::active()->select(['id','name','rack_id','note', 'status'])->with('rack:id,name')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action='';
                    if(auth('admin')->user()->can('edit-row')){

                    $action .= '<button  data-href="'.route('backend.itemconfig.row.edit', $row).'"  type="button" 
                    class="btn btn-sm btn-info edit_data" 
                    data-toggle="tooltip" data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i></button>';
                    }
                    if(auth('admin')->user()->can('delete-row')){

                    $action .='<button  data-href="'.route('backend.itemconfig.row.destroy', $row).'" type="button"  
                    class="btn btn-sm btn-danger delete_check" data-toggle="tooltip" data-original-title="Delete" aria-describedby="tooltip64483"><i class="icon-trash" aria-hidden="true"></i>
                    </button >'; 
                    }
                    else{
                        $action.='';
                    }
                    return $action;
                })
                ->editColumn('rack_id', function($row){
                    return optional($row->rack)->name;
                })
                ->removeColumn(['id'])
                ->rawColumns(['action'])
                ->make(true);
              
        }
       return view('backend.item.row.index');
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
        if(auth('admin')->user()->can('create-row')){

        return view('backend.item.row.create')->with(['racks' => Rack::get(['id', 'name'])]);
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
            return response()->json(['success' =>$returnData->getData()->msg, 'status' =>true], 200) ;
        }
        return response()->json(['error' =>$returnData->getData()->msg, 'status' =>false], 400) ;
      
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
    public function edit(Row $row )
    {
        return view('backend.item.row.edit',compact('row'))->witH(['racks' => Rack::get(['id', 'name'])]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Row $row)
    {
        $returnData = $request->updateData($request, $row);
        if($returnData->getData()->status){
            return response()->json(['success' =>$returnData->getData()->msg, 'status' =>true], 200) ;
        }
        return response()->json(['error' =>$returnData->getData()->msg, 'status' =>false], 400) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Row $row)
    {
        try {
            $row->delete();
        } catch (\Exception $ex) {
            return back()->with(['status' => false, 'mes' =>$ex->getMessage()]);
        }
        return  response()->json(['status' => true, 'mes' => 'Data Deleted Successfully']);   
    }
}

