<?php

namespace App\Http\Controllers\Backend\Order;

use App\Http\Controllers\Controller;
use App\Models\FinancialYearHistory;
use App\Models\Inventory\InventoryItem;
use App\Models\ItemCount;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PendingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data = Order::whereHas('orderStatus', function($query){
            $query->whereStatus('pending');
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
                // href="'.route('backend.order.order-list-pending.show', $row).'"
                ->addColumn('action', function ($row) {
                    $action ='<div class="dropdown">
                    <button class="btn btn-md dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false" ><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                        <div class="dropdown-menu" style="min-width: auto !important;">
                        <a href="'.route('backend.order.order-list-pending.show', $row).'" class="dropdown-item edit_check"
                            data-toggle="tooltip" data-original-title="Show"><i class="fa fa-eye mr-2" aria-hidden="true"></i>
                        </a>
                        <a href="'.route('backend.pos.edit', $row).'" class="dropdown-item edit_check"
                            data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a data-href="'.route('backend.order.order-list-pending.destroy', $row).'"class="dropdown-item delete_check"  data-toggle="tooltip"
                            data-original-title="Delete" aria-describedby="tooltip64483"><i class="fa fa-trash mr-2" aria-hidden="true"></i>
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
                    return  optional($row->createdBy)->name??'';
                })
                // ->editColumn('status', function($row){
                //     return view('components.backend.forms.input.input-switch', ['status' => $row->status ]);
                // })
                ->removeColumn(['id'])
                ->rawColumns(['action'])
                ->make(true);

        }
        $status=  (object)[['name' =>'Active', 'id' =>1 ],['name' =>'Inactive', 'id' => 0 ]];

        return view('backend.order.pending', compact('status'));
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
        $order =Order::whereId($request->order_id)
        ->with('orderItems.item:id,name')
        ->first();

        try {
            DB::beginTransaction();
            if($request->status == 'delivered'){
                for ($i=0; $i <count($order->orderItems) ; $i++) {
                    ItemCount::updateOrCreate([
                        'item_id' =>$order->orderItems[$i]->item_id??null,
                        'date'  =>FinancialYearHistory::latest()->first()->start_date
                    ],[
                        'sell_qty' => DB::raw('sell_qty+'.$order->orderItems[$i]->qty) ,
                    ]);
                    InventoryItem::updateOrCreate([
                        'warehouses_id' =>1,
                        'item_id' => $order->orderItems[$i]->item_id??null,
                        'date' =>FinancialYearHistory::latest()->first()->start_date
                    ],[
                        'sell_qty' => DB::raw('sell_qty+'.$order->orderItems[$i]->qty) ,
                    ]);
                }

            }
            $order->orderStatus()->update(
                [
                    'status' => $request->status,
                ]
            );

            DB::commit();
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }

        return redirect()->route('backend.order.order-list-pending.index')->with('success', 'Order status updated successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::whereId($id)->with(['orderItems.item:id,name'])->with('orderStatus')->first();
        $status=  (object)[['name' =>'Processing', 'id' =>'processing'],['name' =>'Delivered', 'id' => 'delivered' ]];

        return view('backend.order.pendingShow',
        compact('order', 'status'));
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
        try {
            DB::beginTransaction();
            $order = Order::whereId($id)->first();
            $order->orderItems()->delete();
            $order->paymentHistories()->delete();
            $order->orderLastStatus()->delete();
            $order->orderShipment()->delete();
            $order->orderTables()->delete();
            $order->dailyTransactions()->delete();
            $order->cashflowTransactions()->delete();
            $order->delete();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['mes' => $ex->getMessage(), 'status' => false]);
        }
        return response()->json(['mes' => 'Order deleted successfully', 'status' => true]);
    }
}
