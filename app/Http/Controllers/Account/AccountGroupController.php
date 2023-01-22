<?php

namespace App\Http\Controllers\Account;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Models\Account\AccountGroup;
use App\Models\Account\AccountHead;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Account\AccountGroup\StoreRequest;
use App\Http\Requests\Account\AccountGroup\UpdateRequest;
use Illuminate\Support\Facades\DB;

class AccountGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = AccountGroup::select(['id', 'name','note', 'account_head_id','status'])->latest();
        if($request->status == '1'){ 
            $data = $data->active();
        }elseif($request->status == '0'){
            $data = $data->inactive();
        }
        
        $data = $data->get();
        if($request->optionData) {
            return response()->json(['data' =>$data]);
        }
        // dd( $data);
        if (request()->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action ='<div class="dropdown">
                    <button class="btn btn-md dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false" ><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                        <div class="dropdown-menu">
                        <a data-href="'.route('backend.account.accountgroup.edit', $row).'" class="dropdown-item edit_check"
                            data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit mr-2" aria-hidden="true"></i> Edit
                        </a>
                        <div class="dropdown-divider"></div>
                        <a data-href="'.route('backend.account.accountgroup.destroy', $row).'"class="dropdown-item delete_check"  data-toggle="tooltip" 
                            data-original-title="Delete" aria-describedby="tooltip64483"><i class="fa fa-trash mr-2" aria-hidden="true"></i> Delete
                        </a>
                    </div></div>';
                    return $action;
                })
                
                ->editColumn('account_head_id', function($row){
                    return  optional($row->accountHead)->name;
                })
                ->editColumn('status', function($row){
                    return view('components.backend.forms.input.input-switch', ['status' => $row->status ]);
                
                })
                ->removeColumn(['id'])
                ->rawColumns(['action'])
                ->make(true);
          
        }
        $status=  (object)[['name' =>'Active', 'id' =>1 ],['name' =>'Inactive', 'id' => 0 ]];
        
        return view('backend.account.accountgroup.index', compact('status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $account_heads = AccountHead::get(['id', 'name']);
        return view('backend.account.accountgroup.create', compact('account_heads'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {       
        $returnData = $request->storeData();
        if($returnData->getData()->status){
            (new LogActivity)::addToLog('Account Group Created');
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
    public function edit(AccountGroup $accountgroup )
    {
        $account_heads = AccountHead::get(['id', 'name']);
        return view('backend.account.accountgroup.edit',compact('accountgroup','account_heads'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, AccountGroup $accountgroup)
    {
        $returnData = $request->updateData( $accountgroup);
        if($returnData->getData()->status){
            (new LogActivity)::addToLog('Account Group Updated');
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

    public function destroy(AccountGroup $accountgroup)
    {
        try {
            DB::beginTransaction();
            $accountgroup->delete();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => false, 'mes' =>$ex->getMessage()]);
        }
        (new LogActivity)::addToLog('Account Group Deleted');
        return  response()->json(['status' => true, 'mes' => 'Data Deleted Successfully']);   
    }
}

