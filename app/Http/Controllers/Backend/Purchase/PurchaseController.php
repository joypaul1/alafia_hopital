<?php

namespace App\Http\Controllers\Backend\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Account\AccountLedger;
use App\Models\PaymentSystem;
use App\Models\TaxSetting;
use Illuminate\Http\Request;
use App\Helpers\LogActivity;
use App\Http\Requests\Purchase\StoreRequest;
use App\Models\Purchase\Purchase;
use Yajra\DataTables\Facades\DataTables;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $pur_status=  (object)[['name' =>'Received', 'id' =>'received' ],['name' =>'Pending', 'id' => 'pending' ],['name' => 'Ordered', 'id' => 'ordered']];
        $dis_status =  (object)[['name' =>'Percent', 'id' =>'percent' ],['name' =>'Flat', 'id' => 'flat' ]];

        $data = Purchase::
        latest();
        if($request->status == '1'){
            $data = $data->active();
        }elseif($request->status == '0'){
            $data = $data->inactive();
        }

         $data = $data->get();

        if (request()->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action ='<div class="dropdown">
                    <button class="btn btn-md dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false" ><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                        <div class="dropdown-menu">
                        <a data-href="'.route('backend.purchase.edit', $row).'" class="dropdown-item edit_check"
                            data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit mr-2" aria-hidden="true"></i> Edit
                        </a>
                        <div class="dropdown-divider"></div>
                        <a data-href="'.route('backend.purchase.destroy', $row).'"class="dropdown-item delete_check"  data-toggle="tooltip"
                            data-original-title="Delete" aria-describedby="tooltip64483"><i class="fa fa-trash mr-2" aria-hidden="true"></i> Delete
                        </a>
                    </div></div>';
                    return $action;
                })

                ->editColumn('status', function($row){
                    return view('components.backend.forms.input.input-switch', ['status' => $row->status ]);
                })
                ->editColumn('invoice_number', function($row){
                   return session('invoice_prefix')['purchase'].'-'.$row->invoice_number;
                })
                ->editColumn('supplier_id', function($row){
                   return optional($row->supplier)->name;
                })
                ->editColumn('supplier_id', function($row){
                   return optional($row->supplier)->name;
                })
                ->editColumn('warehouse_id', function($row){
                   return  optional($row->warehouse)->name;
                })
                ->removeColumn(['id'])
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('backend.purchase.home.index', compact('pur_status', 'dis_status'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pur_status=  (object)[['name' =>'Received', 'id' =>'received' ],['name' =>'Pending', 'id' => 'pending' ],
        ['name' => 'Ordered', 'id' => 'ordered']];
        $dis_status =  (object)[['name' =>'Percent', 'id' =>'percent' ],['name' =>'Flat', 'id' => 'flat' ]];
        $payment_methods = PaymentSystem::get(['id', 'name']);
        $payment_accounts = AccountLedger::where('rec_pay', true)->get(['id', 'name']);
        $taxs = TaxSetting::active()->select('id','name', 'type', 'rate')->get();
        return view('backend.purchase.home.create',compact('pur_status', 'dis_status','payment_accounts', 'payment_methods', 'taxs'));
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
            (new LogActivity)::addToLog('Purchase Created');
            return back()->with(['success' => $returnData->getData()->msg]);
            // return response()->json(['success' =>$returnData->getData()->msg, 'status' =>true], 200) ;
        }
        return back()->with(['error' => $returnData->getData()->msg]);

        // return response()->json(['error' =>$returnData->getData()->msg,'status' =>false], 400) ;

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
