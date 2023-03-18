<?php

namespace App\Http\Controllers\Backend\Lab;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Models\Service\ServiceName;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\LabTestTube\StoreRequest;
use App\Http\Requests\LabTestTube\UpdateRequest;
use App\Models\lab\LabTestTube;
use App\Models\Service\ServiceType;

class LabTestTubeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = LabTestTube::select(['id', 'name', 'status', 'price'])->latest();
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
                       <a data-href="' . route('backend.siteConfig.labTestTube.edit', $row) . '" class="dropdown-item edit_check"
                           data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit" aria-hidden="true"></i>
                       </a>
                       <div class="dropdown-divider"></div>
                       <a data-href="' . route('backend.siteConfig.labTestTube.destroy', $row) . '"class="dropdown-item delete_check"  data-toggle="tooltip"
                           data-original-title="Delete" aria-describedby="tooltip64483"><i class="fa fa-trash" aria-hidden="true"></i>
                       </a>
                   </div></div>';
                    return $action;
                })

                ->editColumn('status', function ($row) {
                    return view('components.backend.forms.input.input-switch', ['status' => $row->status]);
                })

                ->editColumn('price', function ($row) {
                    return number_format($row->price, 2) . ' TK';
                })
                ->removeColumn(['id'])
                ->rawColumns(['action'])
                ->make(true);
            // ->json();
        }
        // $status=  (object)[['name' =>'Active', 'id' =>1 ],['name' =>'Inactive', 'id' => 0 ]];
        return view('backend.siteConfig.labTestTube.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $type = ServiceType::select(['id', 'name'])->get();
        return view('backend.siteConfig.labTestTube.create');
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
            (new LogActivity)::addToLog('ServiceName Created');
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
    public function edit(ServiceName $serviceName)
    {
        $type = ServiceType::select(['id', 'name'])->get();

        return view('backend.siteConfig.labTestTube.edit', compact('serviceName', 'type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, ServiceName $serviceName)
    {
        $returnData = $request->updateData($request, $serviceName);
        if ($returnData->getData()->status) {
            (new LogActivity)::addToLog('ServiceName Updated');
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

    public function destroy(ServiceName $service)
    {
        try {
            $service->delete();
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'mes' => $ex->getMessage()]);
        }
        (new LogActivity)::addToLog('ServiceName Deleted');
        return  response()->json(['status' => true, 'mes' => 'Data Deleted Successfully']);
    }
}
