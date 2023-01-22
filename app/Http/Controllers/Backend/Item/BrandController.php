<?php

namespace App\Http\Controllers\Backend\Item;

use App\Helpers\Image;
use App\Helpers\LogActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\StoreRequest;
use App\Http\Requests\Brand\UpdateRequest;
use App\Models\Admin;
use App\Models\Item\Brand;
use Yajra\DataTables\Facades\DataTables;

// use DataTables;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->optionData) {
            $data = Brand::active()->select(['id','name','status'])->latest()->get();
            return response()->json(['data' => $data]);
        }
        if ($request->ajax()) {
            $data = Brand::active()->select(['id','name', 'image','status'])->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action = '<a  href="'.route('backend.itemconfig.brand.edit', $row).'" class="btn btn-sm btn-info" data-toggle="tooltip" data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i></a>';
                    $action .='<button  data-href="'.route('backend.itemconfig.brand.destroy', $row).'" type="button"
                    class="btn btn-sm btn-danger delete_check" data-toggle="tooltip" data-original-title="Delete" aria-describedby="tooltip64483"><i class="icon-trash" aria-hidden="true"></i>
                    </button >';
                    return $action;
                })
                ->editColumn('image', function($row){
                    return  asset($row->image);
                })
                ->removeColumn(['id'])
                ->rawColumns(['action'])
                ->make(true);

        }
       return view('backend.item.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.item.brand.create');
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
            (new LogActivity)::addToLog('Banner Created');
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
    public function edit(Brand $brand )
    {

        return view('backend.item.brand.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Brand $brand)
    {
        $returnData = $request->updateData($request, $brand);
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
    public function destroy(Brand $brand)
    {
        try {
            (new Image)->deleteIfExists($brand->image);
            $brand->delete();
        } catch (\Exception $ex) {
            return back()->with(['status' => false, 'mes' =>$ex->getMessage()]);
        }
        return  response()->json(['status' => true, 'mes' => 'Data Deleted Successfully']);
    }
}

