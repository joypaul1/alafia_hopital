<?php

namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Appointment\Appointment;
use App\Models\Appointment\DialysisAppointment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {



        return view('backend.dashboard.index');
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
        ];
        return view('backend.dashboard.lab-report', compact('units'));
    }
}
