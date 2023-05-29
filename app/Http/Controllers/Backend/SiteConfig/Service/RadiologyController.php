<?php

namespace App\Http\Controllers\Backend\SiteConfig\Service;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\RadiologyServiceName\StoreRequest;
use App\Http\Requests\RadiologyServiceName\UpdateRequest;
use App\Models\Radiology\RadiologyServiceName;


class RadiologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = RadiologyServiceName::select(['id', 'name', 'status', 'price', 'department'])
            ->latest();
        if ($request->status) {
            $data = $data->active();
        } elseif ($request->status == '0') {
            $data = $data->inactive();
        }


        if ($request->optionData) {
            $data = $data->whereLike($request->optionData);
            return response()->json(['data' => $data->get()]);
        }
        $data = $data->get();
        if (request()->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action = '<div class="dropdown text-center">
                   <button class="btn btn-md dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false" ><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                       <div class="dropdown-menu" style="min-width:auto !important">
                       <a data-href="' . route('backend.siteConfig.radiology_serviceName.edit', $row) . '" class="dropdown-item edit_check"
                           data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit" aria-hidden="true"></i>
                       </a>
                       <div class="dropdown-divider"></div>
                       <a data-href="' . route('backend.siteConfig.radiology_serviceName.destroy', $row) . '"class="dropdown-item delete_check"  data-toggle="tooltip"
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
                ->editColumn('department', function ($row) {
                    return ucwords($row->department);
                })
                ->removeColumn(['id'])
                ->rawColumns(['action'])
                ->make(true);
            // ->json();
        }
        // $status=  (object)[['name' =>'Active', 'id' =>1 ],['name' =>'Inactive', 'id' => 0 ]];
        return view('backend.siteConfig.radiology.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = (object)[
            ['name' => 'X-Ray', 'id' => 'X-ray'],
            ['name' => 'Echo', 'id' => 'Echo'],
            ['name' => 'Ultrasonography', 'id' => 'Ultrasonography'],
            ['name' => 'ECG', 'id' => 'ECG'],
            ['name' => 'Hematology', 'id' => 'Hematology'],
            ['name' => 'Biochemistry', 'id' => 'Biochemistry'],
            ['name' => 'Micro Biology', 'id' => 'Micro Biology'],
            ['name' => 'Serology', 'id' => 'Serology'],
            ['name' => 'Immunology', 'id' => 'Immunology'],
            ['name' => 'Urine', 'id' => 'Urine'],
            ['name' => 'Blood', 'id' => 'Blood'],
            ['name' => 'Stool', 'id' => 'Stool'],
            ['name' => 'Cardiology', 'id' => 'Cardiology'],
            ['name' => 'Cancer Marker', 'id' => 'Cancer Marker'],
            ['name' => 'Drug Monitoring', 'id' => 'Drug Monitoring'],
            ['name' => 'Hepatitis Profile', 'id' => 'Hepatitis Profile'],
            ['name' => 'Hormone Test', 'id' => 'Hormone Test'],
            ['name' => 'PCR LAB TEST/ MOLECULAR', 'id' => 'PCR LAB TEST/ MOLECULAR'],
            ['name' => 'Torch  Panel', 'id' => 'Torch  Panel'],
        ];
        // $departments= (object)[['name' =>'X-Ray', 'id' =>'X-ray' ], ['name'=> 'Ultrasonography' , 'id' => 'Ultrasonography'], ['name'=> 'ECG', 'id'=> 'ECG']];
        return view('backend.siteConfig.radiology.create', compact('departments'));
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
    public function edit($id)
    {

        $departments = (object)[
            ['name' => 'X-Ray', 'id' => 'X-ray'],
            ['name' => 'Echo', 'id' => 'Echo'],
            ['name' => 'Ultrasonography', 'id' => 'Ultrasonography'],
            ['name' => 'ECG', 'id' => 'ECG'],
            ['name' => 'Hematology', 'id' => 'Hematology'],
            ['name' => 'Biochemistry', 'id' => 'Biochemistry'],
            ['name' => 'Micro Biology', 'id' => 'Micro Biology'],
            ['name' => 'Serology', 'id' => 'Serology'],
            ['name' => 'Immunology', 'id' => 'Immunology'],
            ['name' => 'Urine', 'id' => 'Urine'],
            ['name' => 'Blood', 'id' => 'Blood'],
            ['name' => 'Stool', 'id' => 'Stool'],
            ['name' => 'Cardiology', 'id' => 'Cardiology'],
            ['name' => 'Cancer Marker', 'id' => 'Cancer Marker'],
            ['name' => 'Drug Monitoring', 'id' => 'Drug Monitoring'],
            ['name' => 'Hepatitis Profile', 'id' => 'Hepatitis Profile'],
            ['name' => 'Hormone Test', 'id' => 'Hormone Test'],
            ['name' => 'PCR LAB TEST/ MOLECULAR', 'id' => 'PCR LAB TEST/ MOLECULAR'],
            ['name' => 'Torch  Panel', 'id' => 'Torch  Panel'],
        ];
        $radiologyServiceName = RadiologyServiceName::findOrFail($id);
        return view('backend.siteConfig.radiology.edit', compact('radiologyServiceName', 'departments'));
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

        $radiologyServiceName = RadiologyServiceName::findOrFail($id);

        $returnData = $request->updateData($request, $radiologyServiceName);
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

    public function destroy(RadiologyServiceName $radiologyServiceName)
    {
        try {
            $radiologyServiceName->delete();
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'mes' => $ex->getMessage()]);
        }
        (new LogActivity)::addToLog('ServiceName Deleted');
        return  response()->json(['status' => true, 'mes' => 'Data Deleted Successfully']);
    }
}
