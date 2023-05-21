<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use App\Models\Account\AccountHead;
use App\Models\Appointment\Appointment;
use App\Models\DailyAccountTransaction;
use App\Models\Doctor\Doctor;
use App\Models\Employee\Department;
use App\Models\Order;
use App\Models\Transaction\CashFlow;
use App\Models\Transaction\CashFlowHistory;
use App\Models\Transaction\TransactionHistory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{

    public function incomeReport(Request $request)
    {
        $netSell = Order::whereHas('orderStatus', function ($query) {
            $query->whereStatus('paid');
        })
            ->whereDate('date', '>=', date('Y-m-d', strtotime($request->start_date ?? date('Y-m-d'))))
            ->whereDate('date', '<=', date('Y-m-d', strtotime($request->end_date ?? date('Y-m-d'))))
            ->sum('total');

        $othersIncome = AccountHead::whereName('Income')->with(['groups.ledgers.transaction' => function ($transaction) use ($request) {
            $transaction->whereDate('date', '>=', date('Y-m-d', strtotime($request->start_date ?? date('Y-m-d'))))
                ->whereDate('date', '<=', date('Y-m-d', strtotime($request->end_date ?? date('Y-m-d'))));
        }])->first();
        return view('backend.report.income', compact('netSell', 'othersIncome'));
    }
    public function expenseReport(Request $request)
    {
        $othersExpense = AccountHead::whereName('Expenses')->with(['groups.ledgers.transaction' => function ($transaction) use ($request) {
            $transaction->whereDate('date', '>=', date('Y-m-d', strtotime($request->start_date ?? date('Y-m-d'))))
                ->whereDate('date', '<=', date('Y-m-d', strtotime($request->end_date ?? date('Y-m-d'))));
        }])->first();
        return view('backend.report.expense', compact('othersExpense'));
    }

    public function profitReport(Request $request)
    {
        $netSell = Order::whereHas('orderStatus', function ($query) {
            $query->whereStatus('paid');
        })
            ->whereDate('date', '>=', date('Y-m-d', strtotime($request->start_date ?? date('Y-m-d'))))
            ->whereDate('date', '<=', date('Y-m-d', strtotime($request->end_date ?? date('Y-m-d'))))
            ->sum('total');

        $othersIncome = AccountHead::whereName('Income')->with(['groups.ledgers.transaction' => function ($transaction) use ($request) {
            $transaction->whereDate('date', '>=', date('Y-m-d', strtotime($request->start_date ?? date('Y-m-d'))))
                ->whereDate('date', '<=', date('Y-m-d', strtotime($request->end_date ?? date('Y-m-d'))));
        }])->first();
        $othersExpense = AccountHead::whereName('Expenses')->with(['groups.ledgers.transaction' => function ($transaction) use ($request) {
            $transaction->whereDate('date', '>=', date('Y-m-d', strtotime($request->start_date ?? date('Y-m-d'))))
                ->whereDate('date', '<=', date('Y-m-d', strtotime($request->end_date ?? date('Y-m-d'))));
        }])->first();
        return view('backend.report.profitReport', compact('netSell', 'othersIncome'));
    }

    public function dayBook(Request $request)
    {
        $daybooks = DailyAccountTransaction::with('transactionHistories')
            ->get();

        return view('backend.report.daybook', compact('daybooks'));
    }
    public function cashFlow(Request $request)
    {
        $cashFlows = CashFlow::with('ledger:id,name')
            ->with('method:id,name')
            ->with('cashflowHistory')
            ->get();
        // $model = new $media->cashflowable_type;
        // return  $media->model = $model->findOrFail($media->cashflowable_id);
        return view('backend.report.cashflow', compact('cashFlows'));
    }

    public function sellReport(Request $request)
    {
        $data = Order::whereHas('orderStatus', function ($query) {
            $query->whereStatus('paid');
        })
            ->when($request->start_date, function ($query) use ($request) {
                if ($request->start_date === true) {
                    return $query->whereDate('date', '>=', date('Y-m-d'));
                } else {
                    return $query->whereDate('date', '>=', date('Y-m-d', strtotime($request->start_date)));
                }
            })
            ->when($request->end_date, function ($query) use ($request) {
                if ($request->end_date === true) {
                    return $query->where('date', '<=', date('Y-m-d'));
                } else {
                    return $query->whereDate('date', '<=',  date('Y-m-d', strtotime($request->end_date)));
                }
            })
            ->with('orderItems')
            // ->with('paymentHistories')
            ->latest();
        if ($request->status) {
            $data = $data->active();
        } elseif ($request->status == '0') {
            $data = $data->inactive();
        }

        $data = $data->get();

        if (request()->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('item_qty', function ($row) {
                    return  count($row->orderItems);
                })
                ->addColumn('date', function ($row) {
                    // return  optional($row->user)->name??'';
                    return date('d-m-y', strtotime($row->date));
                })
                ->editColumn('coupon_amount', function ($row) {
                    return  number_format($row->coupon_amount, 2);
                })
                ->editColumn('sub_total', function ($row) {
                    return  number_format($row->sub_total, 2);
                })
                ->editColumn('total', function ($row) {
                    return  number_format($row->total, 2);
                })
                ->editColumn('vat', function ($row) {
                    return  number_format($row->vat, 2);
                })
                // ->editColumn('created_by', function($row){
                //     return  optional($row->user)->name??'';
                // })
                // ->editColumn('status', function($row){
                //     return view('components.backend.forms.input.input-switch', ['status' => $row->status ]);
                // })
                ->removeColumn(['id'])
                ->rawColumns(['action'])
                ->make(true);
        }
        $status =  (object)[['name' => 'Active', 'id' => 1], ['name' => 'Inactive', 'id' => 0]];
        return view('backend.report.sellReport', compact('status'));
    }

    public function purchaseReport(Request $request)
    {
        $data = Order::whereHas('orderStatus', function ($query) {
            $query->whereStatus('paid');
        })
            ->when($request->start_date, function ($query) use ($request) {
                if ($request->start_date === true) {
                    return $query->whereDate('date', '>=', date('Y-m-d'));
                } else {
                    return $query->whereDate('date', '>=', date('Y-m-d', strtotime($request->start_date)));
                }
            })
            ->when($request->end_date, function ($query) use ($request) {
                if ($request->end_date === true) {
                    return $query->where('date', '<=', date('Y-m-d'));
                } else {
                    return $query->whereDate('date', '<=',  date('Y-m-d', strtotime($request->end_date)));
                }
            })
            ->with('orderItems')
            // ->with('paymentHistories')
            ->latest();
        if ($request->status) {
            $data = $data->active();
        } elseif ($request->status == '0') {
            $data = $data->inactive();
        }

        $data = $data->get();

        if (request()->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('item_qty', function ($row) {
                    return  count($row->orderItems);
                })
                ->addColumn('date', function ($row) {
                    // return  optional($row->user)->name??'';
                    return date('d-m-y', strtotime($row->date));
                })
                ->editColumn('coupon_amount', function ($row) {
                    return  number_format($row->coupon_amount, 2);
                })
                ->editColumn('sub_total', function ($row) {
                    return  number_format($row->sub_total, 2);
                })
                ->editColumn('total', function ($row) {
                    return  number_format($row->total, 2);
                })
                ->editColumn('vat', function ($row) {
                    return  number_format($row->vat, 2);
                })
                // ->editColumn('created_by', function($row){
                //     return  optional($row->user)->name??'';
                // })
                // ->editColumn('status', function($row){
                //     return view('components.backend.forms.input.input-switch', ['status' => $row->status ]);
                // })
                ->removeColumn(['id'])
                ->rawColumns(['action'])
                ->make(true);
        }
        $status =  (object)[['name' => 'Active', 'id' => 1], ['name' => 'Inactive', 'id' => 0]];
        return view('backend.report.purchaseReport', compact('status'));
    }

    public function patientVisit(Request $request)
    {

        // dd($request->all());
        $history = [];
        $firstVisit = 0;
        $secondVisit = 0;
        $doctor = Doctor::get()->map(function ($doctor) {
            $data['id'] = $doctor->id;
            $data['name'] = $doctor->first_name . ' ' . $doctor->last_name;
            $data['department'] = $doctor->department->name;
            return $data;
        });
        if ($request->doctor_id) {
            $startDate = date('Y-m-d', strtotime($request->start_date));
            $endDate = date('Y-m-d', strtotime($request->end_date));
            $history = Appointment::where('doctor_id', $request->doctor_id)->select('id', 'doctor_id', 'patient_id', 'appointment_date')
                ->whereBetween('appointment_date', [$startDate, $endDate])
                ->with('patient:id,name')->get();

            $patientVisit= $history->groupBy('patient_id');
            foreach ($patientVisit as $key => $value) {
                if (count($value) == 1) {
                    $firstVisit++;
                } else {
                    $secondVisit++;
                }
            }
        }
        $department = Department::get()->map(function ($doctor) {
            $data['id'] = $doctor->id;
            $data['name'] = $doctor->name;
            return $data;
        });

        return view('backend.report.patientVisit', compact('doctor', 'department', 'history','firstVisit','secondVisit'));
    }
}
