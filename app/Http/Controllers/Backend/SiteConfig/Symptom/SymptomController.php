<?php

namespace App\Http\Controllers\Backend\SiteConfig\Symptom;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Models\Symptom\Symptom;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Symptom\StoreRequest;
use App\Http\Requests\Symptom\UpdateRequest;
use App\Models\Symptom\SymptomType;

class SymptomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(auth('admin')->user()->can('view-symptom-config')){

        $data = Symptom::select(['id', 'name', 'status', 'description', 'symptom_type_id'])->latest();
        if ($request->status) {
            $data = $data->active();
        } elseif ($request->status == '0') {
            $data = $data->inactive();
        }

        $data = $data->get();
        if ($request->optionData) {
            return response()->json(['data' => $data]);
        }
        if (request()->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action = '<div class="dropdown text-center">
                   <button class="btn btn-md dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false" ><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                       <div class="dropdown-menu" style="min-width:auto !important">
                       <a data-href="' . route('backend.siteConfig.symptom.edit', $row) . '" class="dropdown-item edit_check"
                           data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit" aria-hidden="true"></i>
                       </a>
                       <div class="dropdown-divider"></div>
                       <a data-href="' . route('backend.siteConfig.symptom.destroy', $row) . '"class="dropdown-item delete_check"  data-toggle="tooltip"
                           data-original-title="Delete" aria-describedby="tooltip64483"><i class="fa fa-trash" aria-hidden="true"></i>
                       </a>
                   </div></div>';
                    return $action;
                })

                ->editColumn('status', function ($row) {
                    return view('components.backend.forms.input.input-switch', ['status' => $row->status]);
                })
                ->editColumn('symptom_type_id', function ($row) {
                    return optional($row->symptomType)->name ?? ' ';
                })
                ->removeColumn(['id'])
                ->rawColumns(['action'])
                ->make(true);
        }
        // $status=  (object)[['name' =>'Active', 'id' =>1 ],['name' =>'Inactive', 'id' => 0 ]];
        return view('backend.siteConfig.symptom.index');

    }        abort(403, 'Unauthorized action.');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth('admin')->user()->can('create-symptom-config')){

        $type = SymptomType::select(['id', 'name'])->get();
        return view('backend.siteConfig.symptom.create', compact('type'));
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
            (new LogActivity)::addToLog('Symptom Created');
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
    public function edit(Symptom $symptom)
    {
        if(auth('admin')->user()->can('edit-symptom-config')){

        $type = SymptomType::select(['id', 'name'])->get();

        return view('backend.siteConfig.symptom.edit', compact('symptom', 'type'));
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
    public function update(UpdateRequest $request, Symptom $symptom)
    {
        $returnData = $request->updateData($request, $symptom);
        if ($returnData->getData()->status) {
            (new LogActivity)::addToLog('Symptom Updated');
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

    public function destroy(Symptom $symptom)
    {
        if(auth('admin')->user()->can('delete-symptom-config')){

        try {
            $symptom->delete();
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'mes' => $ex->getMessage()]);
        }
        (new LogActivity)::addToLog('Symptom Deleted');
        return  response()->json(['status' => true, 'mes' => 'Data Deleted Successfully']);
    }
    abort(403, 'Unauthorized action.');

}
}
