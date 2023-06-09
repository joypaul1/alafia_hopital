<?php

use App\Http\Controllers\Auth\Backend\LoginController;
use App\Models\lab\LabTest;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('print', function () {
    return view('welcome');
});
Route::get('/',[LoginController::class, 'showLoginForm'])->name('home');
Route::get('/reportDesign', function () {

    $units = (object)[
        ['id' => 'mg/dl', 'name' => 'mg/dl'],
        ['id' => 'mmol/l', 'name' => 'mmol/l'],
        ['id' => 'Nil', 'name' => 'Nil'],
        ['id' => 'µg/dl' , 'name' => 'µg/dl' ],
        ['id' => 'U/L' , 'name' => 'U/L' ],
        ['id' => 'g/dl' , 'name' => 'g/dl' ],
        ['id' => 'mmol/l' , 'name' => 'mmol/l' ],
        ['id' => '%' , 'name' => '%' ],
        ['id' => 'N/A' , 'name' => 'N/A' ],
        ['id' => 'IU/mL' , 'name' => 'IU/mL' ],
        ['id' => 'mg/L' , 'name' => 'mg/L' ],
    ];
    return view('backend.dashboard.lab-report(CultureofBlood)', compact('units'));
    // return view('backend.dashboard.lab-report(Serology)', compact('units'));
    // return view('backend.dashboard.lab-report(CultureofBlood)', compact('units'));
});
