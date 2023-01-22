<?php

namespace App\Http\Controllers\Backend\Order;

use App\Http\Controllers\Controller;
use App\Models\Account\AccountLedger;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\PaymentSystem;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DeliveredController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Order::whereHas('orderStatus', function($query){
            $query->whereStatus('delivered');
        })->with('orderItems')->latest();
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
                                    <div class="dropdown-menu">
                                    <a href="'.route('backend.order.order-list-delivered.show', $row).'" class="dropdown-item"
                                        data-toggle="tooltip" data-original-title="Show"><i class="fa fa-edit mr-2" aria-hidden="true"></i> Show
                                    </a>
                            </div></div>';
                    return $action;
                })

                ->addColumn('item_qty', function($row){
                    return  count($row->orderItems);
                })
                ->addColumn('user', function($row){
                    return  optional($row->user)->name??'';
                })
                ->editColumn('coupon_amount', function($row){
                    return  number_format($row->coupon_amount, 2);
                })
                ->editColumn('sub_total', function($row){
                    return  number_format($row->sub_total, 2);
                })
                ->editColumn('total', function($row){
                    return  number_format($row->total, 2);
                })
                ->editColumn('vat', function($row){
                    return  number_format($row->vat, 2);
                })
                ->editColumn('created_by', function($row){
                    return  optional($row->user)->name??'';
                })

                // ->editColumn('status', function($row){
                //     return view('components.backend.forms.input.input-switch', ['status' => $row->status ]);
                // })
                ->removeColumn(['id'])
                ->rawColumns(['action'])
                ->make(true);

        }
        $status=  (object)[['name' =>'Active', 'id' =>1 ],['name' =>'Inactive', 'id' => 0 ]];

        return view('backend.order.delivered', compact('status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  $order =Order::whereId($request->order_id)->first();
        // $v = $order->orderStatus()->updateOrCreate([
        //         'order_id' => $request->order_id,
        //     ],
        //     [
        //         'status' => $request->status,
        //     ]
        // );
        // dd($request->status);
        // $v = OrderStatus::where('order_id', $request->order_id)->update(['status' => $request->status]);
        // dd($v);
        // return redirect()->route('backend.order.order-list-delivered.index')->with('success', 'Order status updated successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::whereId($id)->with(['orderItems.item:id,name'])
        ->with('orderStatus')
       ->first();
        $dis_status =  (object)[['name' =>'Percent', 'id' =>'percent' ],['name' =>'Flat', 'id' => 'flat' ]];
        $payment_methods = PaymentSystem::get(['id', 'name']);
        $payment_accounts = AccountLedger::where('rec_pay', true)->get(['id', 'name']);
        return view('backend.order.show',
        compact('order', 'dis_status',
         'payment_methods', 'payment_accounts'));
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
