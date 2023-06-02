<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AppointmentController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/department', [AppointmentController::class, 'department']);
Route::get('/doctor', [AppointmentController::class, 'doctor']);
Route::get('/departmentWiseDoctor', [AppointmentController::class, 'departmentWiseDoctor']);
Route::get('/slot', [AppointmentController::class, 'slot']);
Route::get('/getSerialNumber', [AppointmentController::class, 'getSerialNumber']);
