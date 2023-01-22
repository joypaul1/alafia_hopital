<?php

namespace App\Http\Controllers\Backend\Item;

use App\Http\Controllers\Controller;
use App\Http\Requests\Item\Rack\StoreRequest;
use App\Http\Requests\Item\Rack\UpdateRequest;
use App\Models\Item\Rack;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->optionData) {
            $data = Rack::select(['id','name'])->latest()->get();
            return response()->json(['data' => $data]);
        }    
            
        if ($request->ajax()) {
            $data = Rack::select(['id','name','note', 'status'])->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action = '<button  data-href="'.route('backend.itemconfig.rack.edit', $row).'"  type="button" 
                    class="btn btn-sm btn-info edit_data" 
                    data-toggle="tooltip" data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i></button>';
                    $action .='<button  data-href="'.route('backend.itemconfig.rack.destroy', $row).'" type="button"  
                    class="btn btn-sm btn-danger delete_check" data-toggle="tooltip" data-original-title="Delete" aria-describedby="tooltip64483"><i class="icon-trash" aria-hidden="true"></i>
                    </button >'; 
                    return $action;
                })
                ->removeColumn(['id'])
                ->rawColumns(['action'])
                ->make(true);
              
        }
       return view('backend.item.rack.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.item.rack.create');
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
    public function edit(Rack $rack )
    {
        return view('backend.item.rack.edit',compact('rack'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Rack $rack)
    {
        $returnData = $request->updateData($request, $rack);
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
    public function destroy(Rack $rack)
    {
        try {
            $rack->delete();
        } catch (\Exception $ex) {
            return back()->with(['status' => false, 'mes' =>$ex->getMessage()]);
        }
        return  response()->json(['status' => true, 'mes' => 'Data Deleted Successfully']);   
    }
}
