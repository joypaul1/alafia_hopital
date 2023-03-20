<?php

namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Order;
use App\Models\User;
use App\Traits\SMS;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // use SMS;
    public function index(Request $request)
    {
        $weaklyData['days'] = [];
        $weaklyData['sell'] = [];
        $monthData['month'] = [];
        $monthData['monthlySell'] = [];
        for ($i = 0; $i < 7; $i++) {
            $date =  Carbon::now()->startOfWeek()->addDays($i)->format('Y-m-d');
            $days =  Carbon::now()->startOfWeek()->addDays($i)->format('D');
            $sell = Order::whereDate('date', $date)
                ->whereHas('orderStatus', function ($query) {
                    $query->whereStatus('paid');
                })
                ->get()->sum('payable_amount');
            array_push($weaklyData['days'], $days);
            array_push($weaklyData['sell'], $sell);
        }

        for ($month = 1; $month <= 12; $month++) {
            $monthName =  Carbon::now()->month($month)->format('M');
            $sell = Order::whereMonth('date', $month)
                ->whereYear('date', date('Y'))
                ->whereHas('orderStatus', function ($query) {
                    $query->whereStatus('paid');
                })
                ->get()->sum('payable_amount');
            array_push($monthData['month'], $monthName);
            array_push($monthData['monthlySell'], $sell);
        }

        $userSell = Admin::select('id', 'name')->withCount([
            'orders AS total_sell' => function ($query) {
                $query->whereHas('orderStatus', function ($status) {
                    $status->whereStatus('paid');
                })
                    ->select(DB::raw("SUM(payable_amount)"));
            }
        ])

            ->get()->toArray();
        $totalOrder = Order::whereHas('orderStatus', function ($query) {
            $query->whereStatus('paid');
        })->count();
        $todayCountOrder = Order::whereDate('date', date('Y-m-d'))
            ->whereHas('orderStatus', function ($query) {
                $query->whereStatus('paid');
            })->count();
        $todayOrder = Order::whereDate('date', date('Y-m-d'))
            ->whereHas('orderStatus', function ($query) {
                $query->whereStatus('paid');
            })->sum('payable_amount');
        $todayPendingOrder = Order::whereDate('date', date('Y-m-d'))
            ->whereHas('orderStatus', function ($query) {
                $query->whereStatus('paid');
            })->count();
        $totalSell = 0;
        $totalSell = Order::whereHas('orderStatus', function ($query) {
            $query->whereStatus('paid');
        })->sum('payable_amount');
        $totalSell = round($totalSell);
        $totalVat = 0;
        $totalVat = Order::whereHas('orderStatus', function ($query) {
            $query->whereStatus('paid');
        })->sum('payable_amount');
        $totalVat = round($totalVat * 15 / 100);


        return view('backend.dashboard.index', compact(
            'weaklyData',
            'totalSell',
            'todayCountOrder',
            'totalVat',
            'monthData',
            'userSell',
            'todayOrder',
            'todayPendingOrder'
        ));
    }
    public function labReport()
    {
        $units = (object)[
            ['id' => 'mg/dl', 'name' => 'mg/dl'],
            ['id' => 'mmol/l', 'name' => 'mmol/l'],
            ['id' => 'Nil', 'name' => 'Nil'],
            ['id' => 'µg/dl' , 'name' => 'µg/dl' ],
            ['id' => 'U/L' , 'name' => 'U/L' ],
            ['id' => 'g/dl' , 'name' => 'g/dl' ],
            ['id' => 'mmol/l' , 'name' => 'mmol/l' ],
            ['id' => '%' , 'name' => '%' ],
            ['id' => 'ng/ml' , 'name' => 'ng/ml' ],
            ['id' => 'mlu/L' , 'name' => 'mlu/L' ],
            ['id' => 'pg/mL' , 'name' => 'pg/mL' ],
        ];
        return view('backend.dashboard.lab-report', compact('units'));
    }
}
