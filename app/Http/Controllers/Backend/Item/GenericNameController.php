<?php

namespace App\Http\Controllers\Backend\Item;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Http\Requests\Item\GenericName\StoreRequest;
use App\Http\Requests\Item\GenericName\UpdateRequest;
use App\Models\Item\GenericName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class GenericNameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(auth('admin')->user()->can('view-genericname')){

        if ($request->optionData) {
            $data = GenericName::select(['id', 'name'])->latest()->get();
            return response()->json(['data' => $data]);
        }

        if ($request->ajax()) {
            $data = GenericName::select(['id', 'name', 'note', 'status'])->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action = '<button  data-href="' . route('backend.itemconfig.generic-name.edit', $row) . '"  type="button" 
                    class="btn btn-sm btn-info edit_data" 
                    data-toggle="tooltip" data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i></button>';
                    $action .= '<button  data-href="' . route('backend.itemconfig.generic-name.destroy', $row) . '" type="button"  
                    class="btn btn-sm btn-danger delete_check" data-toggle="tooltip" data-original-title="Delete" aria-describedby="tooltip64483"><i class="icon-trash" aria-hidden="true"></i>
                    </button >';
                    return $action;
                })
                ->editColumn('status', function ($row) {
                    return view('components.backend.forms.input.input-switch', ['status' => $row->status]);
                })
                ->removeColumn(['id'])
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.item.generic.index');
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
        if(auth('admin')->user()->can('create-genericname')){

        return view('backend.item.generic.create');
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
        if ($returnData->getData()->status) {
            LogActivity::addToLog('Generic Name Created');
            return response()->json(['success' => $returnData->getData()->msg, 'status' => true], 200);
        }
        return response()->json(['error' => $returnData->getData()->msg, 'status' => false], 400);
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
    public function edit(GenericName $genericName)
    {
        if(auth('admin')->user()->can('edit-genericname')){

        return view('backend.item.generic.edit', compact('genericName'));
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
    public function update(UpdateRequest $request, GenericName $genericName)
    {
        // dd($request->all(),$genericName);
        return $returnData = $request->updateData($request, $genericName);
        if ($returnData->getData()->status) {
            LogActivity::addToLog('Generic Name Updated');
            return response()->json(['success' => $returnData->getData()->msg, 'status' => true], 200);
        }
        return response()->json(['error' => $returnData->getData()->msg, 'status' => false], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(GenericName $genericName)
    {
        if(auth('admin')->user()->can('delete-genericname')){

        try {
            DB::beginTransaction();
            $genericName->delete();
            LogActivity::addToLog('Generic Name Deleted');
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();

            return response()->with(['status' => false, 'mes' => $ex->getMessage()]);
        }
        return  response()->json(['status' => true, 'mes' => 'Data Deleted Successfully']);
    }
    abort(403, 'Unauthorized action.');

}
}
