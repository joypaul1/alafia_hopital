<?php

namespace App\Http\Controllers\Backend\Item;

use App\Http\Controllers\Controller;
use App\Models\Item\Size;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Item\Size\StoreRequest;
use App\Http\Requests\Item\Size\UpdateRequest;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Size::select(['id','name','note', 'status'])->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action = '<a  href="'.route('backend.itemconfig.size.edit', $row).'" class="btn btn-sm btn-info" data-toggle="tooltip" data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i></a>';
                    $action .='<button  data-href="'.route('backend.itemconfig.size.destroy', $row).'" type="button"  
                    class="btn btn-sm btn-danger delete_check" data-toggle="tooltip" data-original-title="Delete" aria-describedby="tooltip64483"><i class="icon-trash" aria-hidden="true"></i>
                    </button >'; 
                    return $action;
                })
                ->removeColumn(['id'])
                ->rawColumns(['action'])
                ->make(true);
              
        }
       return view('backend.item.size.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.item.size.create');
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
    public function edit(Size $size )
    {
        return view('backend.item.size.edit',compact('size'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Size $size)
    {
        $returnData = $request->updateData($request, $size);
        if($returnData->getData()->status){
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
    public function destroy(Size $size)
    {
        try {
            $size->delete();
        } catch (\Exception $ex) {
            return back()->with(['status' => false, 'mes' =>$ex->getMessage()]);
        }
        return  response()->json(['status' => true, 'mes' => 'Data Deleted Successfully']);   
    }
}