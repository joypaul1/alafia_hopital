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
        $data = Bed::
        // select('beds.*', 'bed_cabin_id.name as bedCabin', 'bed_groups.name as bedGroup', 'bed_types.name as bedType', 'bed_wards.name as bedWard', 'floors.name as floor')
        with('bedCabin', 'bedGroup', 'bedType', 'bedWard', 'floor')
        ->latest();
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
                   $action ='<div class="dropdown text-center">
                   <button class="btn btn-md dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false" ><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                       <div class="dropdown-menu" style="min-width:auto !important">
                       <a data-href="'.route('backend.siteConfig.bedCabin.edit', $row).'" class="dropdown-item edit_check"
                           data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit" aria-hidden="true"></i>
                       </a>
                       <div class="dropdown-divider"></div>
                       <a data-href="'.route('backend.siteConfig.bedCabin.destroy', $row).'"class="dropdown-item delete_check"  data-toggle="tooltip"
                           data-original-title="Delete" aria-describedby="tooltip64483"><i class="fa fa-trash" aria-hidden="true"></i>
                       </a>
                   </div></div>';
                   return $action;
               })

               ->editColumn('status', function($row){
                   return view('components.backend.forms.input.input-switch', ['status' => $row->status ]);
               })
                ->editColumn('bed_cabin_id', function($row){
                     return $row->bedCabin->name;
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
                // ->editColumn('floor_id', function($row){
                //     return $row->floor->name;
                // })
                // ->editColumn('price', function($row){
                //     return number_format($row->price, 2);
                // })

               ->removeColumn(['id'])
               ->rawColumns(['action'])
               ->make(true);

       }
        // $status=  (object)[['name' =>'Active', 'id' =>1 ],['name' =>'Inactive', 'id' => 0 ]];
        return view('backend.siteConfig.bed.index');
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
        return view('backend.siteConfig.bed.create',
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
        return view('backend.siteConfig.bed.edit',compact('bed'));
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
