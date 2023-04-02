<?php

use App\Http\Controllers\Backend\Appointment\AppointmentController;
use App\Http\Controllers\Backend\Appointment\DialysisAppointmentController;
use Illuminate\Support\Facades\Route;

// Doctor appointment
Route::group(['middleware' => 'admin', 'prefix' =>'admin' , 'as'=>'backend.'], function(){
    Route::resource('appointment', AppointmentController::class);
    // Route::get('appointment/money-receipt/{$id}', [AppointmentController::class, 'moneyReceipt'])->name('appointment.moneyReceipt');
});

// dailyses appointment
Route::group(['middleware' => 'admin', 'prefix' =>'admin' , 'as'=>'backend.'], function(){
    Route::resource('dialysis-appointment', DialysisAppointmentController::class);
    Route::get('dialysis-service-invoice', [DialysisAppointmentController::class, 'serviceInvoice'])->name('dialysis.service.invoice');

});

