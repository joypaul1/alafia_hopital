<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Account\AccountLedger;
use App\Models\FinancialYearHistory;
use App\Models\LedgerTransition;
use App\Models\Order;
use App\Models\Order\OrderTable;
use App\Models\OrderStatus;
use App\Models\PaymentSystem;
use App\Models\TableName;
use App\Models\Transaction\CashFlowHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class OrderController extends Controller
{

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
                        <div class="dropdown-menu" style="min-width: auto !important;">
                        <a target="_blank" href="'.route('backend.pos-pdf.show', $row).'" class="dropdown-item edit_check"
                            data-toggle="tooltip" data-original-title="Print"><i class="fa fa-print mr-2" aria-hidden="true"></i>
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
                ->editColumn('paymentHistories', function($row){
                    return implode(', ', $row->paymentHistories->pluck('ledger.name')->toArray());
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

                ->removeColumn(['id'])
                ->rawColumns(['action'])
                ->make(true);

        }
        $status=  (object)[['name' =>'Active', 'id' =>1 ],['name' =>'Inactive', 'id' => 0 ]];

        return view('backend.order.index', compact('status'));
    }



    public function show($orderId)
    {
        $order = Order::whereId($orderId)->with(['orderItems.item:id,name'])
        ->with('orderStatus')
       ->first();
       $dis_status =  (object)[['name' =>'Percent', 'id' =>'percent' ],['name' =>'Flat', 'id' => 'flat' ]];
       $payment_methods = PaymentSystem::get(['id', 'name']);
       $payment_accounts = AccountLedger::where('rec_pay', true)->get(['id', 'name']);
        return view('backend.order.show',
        compact('order', 'dis_status',
         'payment_methods', 'payment_accounts'));
    }


    public function store(Request $request)
    {

        try {
            DB::beginTransaction();
            $order = Order::whereId($request->order_id)->first();
            $order->update([
                'discount_type' => $request->discount_type,
                'discount' =>   Str::replace(',', '', $request->discount),
                'discount_amount' =>Str::replace(',', '', $request->discount_amount) ,
                'payable_amount' => Str::replace(',', '', $request->payable_amount),
            ]);

            $orderTable =OrderTable::whereOrderId($request->order_id)->get();

            foreach ($orderTable as $key => $value) {
               TableName::whereId($value->table_id)->update(['booked' => false]);
            }
            OrderStatus::where('order_id', $request->order_id)->update(['status' => 'paid']);
            $order->paymentHistories()->create([
                'ledger_id' =>$request->payment_account,
                'payment_method'=> 'cash' ,
                'payment_system_id' =>$request->payment_method,
                'date' =>$request->paid_date,
                'note' =>$request->payment_note,
                'paid_amount' =>Str::replace(',', '', $request->payment_amount),
                'payment_received_id' =>auth('admin')->id(),
            ]);

             //<----start of cash flow Transition------->
            $cashflowTransition= $order->cashflowTransactions()->create([
                'url'               => "Backend\Pos\PosController@show,['id' =>".$order->id."]",
                'cashflow_type'     => 'Sell',
                'description'       => 'Sell Food',
                'date'              => $request->paid_date,
                'ledger_id'         => $request->payment_account,
                'payment_method'    => $request->payment_method,
            ]);

            // cashflowHistories
            $cashflowTransition->cashflowHistory()->create([
                'debit' => Str::replace(',', '', $request->payment_amount)
            ]);
            //<----end of cash flow Transition------->

            //<----start of dailyTransition book transaction------->
            $dailyTransition = $order->dailyTransactions()->create([
                'url'               =>  "Backend\Pos\PosController@show,['id' =>".$order->id."]",
                'description'       => 'Sell Food',
                'transaction_type'  => 'Sell',
                'date'              =>  $request->paid_date,
                'reference_no'      =>  $order->invoice_number,
            ]);

            //credit transactionHistories // sell increase
            $dailyTransition->transactionHistories()->create([
                'entry_name' => 'Sell Food',
                'credit'      => Str::replace(',', '', $request->payment_amount),
            ]);

            //debit transactionHistories // amount increase
            $dailyTransition->transactionHistories()->create([
                'entry_name' => AccountLedger::find($request->payment_account)->name,
                'debit' => Str::replace(',', '', $request->payment_amount),
            ]);

            // LedgerTransition --->increment costing
            LedgerTransition::updateOrCreate([
                'ledger_id'=> $request->payment_account,
                'date'     => FinancialYearHistory::latest()->first()->start_date
            ],[
                'debit' => DB::raw('debit+'. Str::replace(',', '', $request->payment_amount))
            ]);

            DB::commit();

        } catch (\Exception $ex) {
            DB::rollBack();
            dd( $ex->getMessage(), $ex->getLine(), $ex->getFile());
            return back()->with(['error' => $ex->getMessage()]);
        }
        return redirect()->route('backend.pos-pdf.show', $order->id);
        return redirect()->route('backend.order.order-list-delivered.index')->with(['success' => 'Order Paid Successfully']);
    }

}
