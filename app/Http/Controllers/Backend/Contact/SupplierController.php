<?php

namespace App\Http\Controllers\Backend\Contact;

use App\Helpers\LogActivity;
use App\Http\Requests\Supplier\StoreRequest;
use App\Http\Requests\Supplier\UpdateRequest;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data = Supplier::select(['id','name','mobile', 'email','status'])->latest();
        if($request->optionData){
            return response()->json(['data' =>$data->active()->get()]);
        }
        
        if($request->status){ 
            $data = $data->active();
        }elseif($request->status == '0'){
            $data = $data->inactive();
        }
        
        $data = $data->get();
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action ='<div class="dropdown">
                    <button class="btn btn-md dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false" ><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                        <div class="dropdown-menu">
                        <a href="'.route('backend.supplier.edit', $row).'" class="dropdown-item"
                            data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit mr-2" aria-hidden="true"></i> Edit
                        </a>
                        <div class="dropdown-divider"></div>
                        <a data-href="'.route('backend.supplier.destroy', $row).'"class="dropdown-item delete_check"  data-toggle="tooltip" 
                            data-original-title="Delete" aria-describedby="tooltip64483"><i class="fa fa-trash mr-2" aria-hidden="true"></i> Delete
                        </a>
                    </div></div>';
                    return $action;
                })
                ->editColumn('status', function($row){
                    return view('components.backend.forms.input.input-switch', ['status' => $row->status ]);
                })
                ->removeColumn(['id'])
                ->rawColumns(['action'])
                ->make(true);
              
        }
        $status=  (object)[['name' =>'Active', 'id' =>1 ],['name' =>'Inactive', 'id' => 0 ]];

        return view('backend.contact.supplier.index', compact('status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('backend.contact.supplier.create')->with(['countries' =>  Country::get(['name', 'id'])]);
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
            (new LogActivity)::addToLog('Supplier Created');
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
    public function destroy(Supplier $supplier)
    {
        try {
            $supplier->delete();
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'mes' =>$ex->getMessage()]);
        }
        (new LogActivity)::addToLog('Supplier Deleted');

        return  response()->json(['status' => true, 'mes' => 'Data Deleted Successfully']);   
    }

    function ledgerReport(Request $request){
        
        $data = Supplier::select(['id','name'])
        ->when($request->supplier_id, function($query) use ($request){
            return $query->whereId($request->supplier_id);
        })
        ->with(['ledgerReport' => function($ledgerReport){
            $ledgerReport->select('supplier_id', 'debit','credit', 'amount', 'date');
        }])->latest();
       
        $data = $data->get();
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('debit', function($row){
                  return   optional($row->ledgerReport)->debit??0.00;
                })
                ->addColumn('credit', function($row){
                  return   optional($row->ledgerReport)->credit??0.00;
                })
                ->addColumn('amount', function($row){
                  return   optional($row->ledgerReport)->amount??0.00;
                })
                
                ->removeColumn(['id'])
                // ->rawColumns(['action'])
                ->make(true);
              
        }
        $status=  (object)[['name' =>'Active', 'id' =>1 ],['name' =>'Inactive', 'id' => 0 ]];
        $suppliers = $data;
        return view('backend.report.supplierLedger', compact('status', 'suppliers'));
    }


}
