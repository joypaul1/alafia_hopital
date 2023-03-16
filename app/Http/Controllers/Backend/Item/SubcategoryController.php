<?php

namespace App\Http\Controllers\Backend\Item;

use App\Helpers\Image;
use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Http\Requests\Subcategory\StoreRequest;
use App\Http\Requests\SubCategory\UpdateRequest;
use App\Models\Item\Category;
use App\Models\Item\Subcategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(auth('admin')->user()->can('view-subcategory')){

        $data = Subcategory::query()->select('id', 'name', 'slug', 'image', 'status', 'category_id');
        if(request()->ajax() && $request->status) {
            if($request->status){
                $data = $data->active();
            }elseif($request->status == '0'){
                $data = $data->inactive();
            }
        }elseif($request->category_id){
            $data  =  $data->where('category_id', $request->category_id);
            return response()->json(['data' => $data->select('id', 'name')->get()]);
        }
        $data = $data->get();
        if (request()->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action ='<div class="dropdown">
                    <button class="btn btn-md dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false" ><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                        <div class="dropdown-menu">
                        <a data-href="'.route('backend.itemconfig.subcategory.edit', $row).'" class="dropdown-item edit_check"
                            data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit mr-2" aria-hidden="true"></i> Edit
                        </a>
                        <div class="dropdown-divider"></div>
                        <a data-href="'.route('backend.itemconfig.subcategory.destroy', $row).'"class="dropdown-item delete_check"  data-toggle="tooltip"
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
        return view('backend.item.subcategory.index', compact('status'));
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
        if(auth('admin')->user()->can('create-subcategory')){

        return view('backend.item.subcategory.create', ['categories' => Category::get(['id', 'name'])]);
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
		    (new LogActivity)::addToLog('Subcategory Created');
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
    public function edit(Subcategory $subcategory )
    {
        if(auth('admin')->user()->can('edit-subcategory')){

        return view('backend.item.subcategory.edit',['categories' => Category::get(['id', 'name'])],compact('subcategory'));
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
    public function update(UpdateRequest $request, Subcategory $subcategory)
    {
         $returnData = $request->updateData($request, $subcategory);
        if($returnData->getData()->status){
		    (new LogActivity)::addToLog('Subcategory Updated');
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
    public function destroy(Subcategory $subcategory)
    {
        if(auth('admin')->user()->can('delete-subcategory')){

        try {
            (new Image)->deleteIfExists($subcategory->image);
            $subcategory->delete();
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'mes' =>$ex->getMessage()]);
        }
        (new LogActivity)::addToLog('Subcategory Deleted');
        return  response()->json(['status' => true, 'mes' => 'Data Deleted Successfully']);

    }
    abort(403, 'Unauthorized action.');

}



}
