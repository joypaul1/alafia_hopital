<?php

namespace App\Http\Controllers\Backend\Bed;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Models\Bed\Bed;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Bed\StoreRequest;
use App\Http\Requests\Bed\UpdateRequest;
use App\Models\Bed\BedCabin;
use App\Models\Bed\BedGroup;
use App\Models\Bed\BedType;
use App\Models\Bed\BedWard;
use App\Models\Floor;

class BedController extends Controller
{
    public function index(Request $request)
    {
        $data = Bed::with('bedGroup','bedType','bedWard','bedCabin','floor');
        // ->select('name','price', 'bed_group_id', 'bed_type_id', 'bed_ward_id',
        //  'bed_cabin_id', 'floor_id',  'description', 'status')
        // ->latest();
        if($request->status){
            $data = $data->active();
        }elseif($request->status == '0'){
            $data = $data->inactive();
        }

         $data = $data->get();

        if($request->optionData) {
            return response()->json(['data' =>$data]);
        }
        if (request()->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action ='<div class="dropdown">
                    <button class="btn btn-md dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false" ><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                        <div class="dropdown-menu" >

                    </div></div>';
                    return $action;
                })

                ->editColumn('bed_group_id', function($row){
                    return $row->bedGroup->name;
                })
                ->editColumn('bed_type_id', function($row){
                    return $row->bedType->name;
                })
                ->editColumn('bed_ward_id', function($row){
                    return $row->bedWard->name;
                })
                ->editColumn('bed_cabin_id', function($row){
                    return $row->bedCabin->name;
                })
                ->editColumn('floor_id', function($row){
                    return $row->floor->name;
                })
                ->editColumn('price', function($row){
                    return number_format($row->price, 2);
                })
                ->editColumn('status', function($row){
                    return view('components.backend.forms.input.input-switch', ['status' => $row->status ]);

                })
                ->removeColumn(['id'])
                ->rawColumns(['action'])
                ->make(true);

        }
        // $status=  (object)[['name' =>'Active', 'id' =>1 ],['name' =>'Inactive', 'id' => 0 ]];
        return view('backend.siteconfig.bed.index');
    }

      /**
       * Show the form for creating a new resource.
       *$data = Bed::select(['id', 'name', 'status', ''])->latest();
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $group = BedGroup::active()->select(['id', 'name'])->get();
        $type = BedType::active()->select(['id', 'name'])->get();
        $ward = BedWard::active()->select(['id', 'name'])->get();
        $cabin = BedCabin::active()->select(['id', 'name'])->get();
        $floor = Floor::active()->select(['id', 'name'])->get();
        return view('backend.siteconfig.bed.create',
        compact('group', 'type', 'ward', 'cabin', 'floor'));
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
            (new LogActivity)::addToLog('Bed Created');
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
    public function edit(Bed $bed )
    {
        return view('backend.siteconfig.bed.edit',compact('bed'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Bed $bed)
    {
        $returnData = $request->updateData($request, $bed);
        if($returnData->getData()->status){
            (new LogActivity)::addToLog('Bed Updated');
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

    public function destroy(Bed $bed)
    {
        try {
            $bed->delete();

        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'mes' =>$ex->getMessage()]);
        }
        (new LogActivity)::addToLog('Bed Deleted');
        return  response()->json(['status' => true, 'mes' => 'Data Deleted Successfully']);
    }




}
