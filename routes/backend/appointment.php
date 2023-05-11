<?php

use App\Http\Controllers\Backend\Appointment\AppointmentController;
use App\Http\Controllers\Backend\Appointment\DialysisAppointmentController;
use App\Http\Controllers\Backend\Radiology\RadiologyServiceInvoiceController;
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
// radiologyServiceInvoice
Route::group(['middleware' => 'admin', 'prefix' =>'admin' , 'as'=>'backend.'], function(){
    Route::resource('radiologyServiceInvoice', RadiologyServiceInvoiceController::class);
    Route::get('radiologyServiceInvoice/make-test-result/{id}', [RadiologyServiceInvoiceController::class, 'makeResult'])->name('radiologyServiceInvoice.make-test-result');
    Route::post('radiologyServiceInvoice/make-test-result-store/{id}', [RadiologyServiceInvoiceController::class, 'storeResult'])->name('radiologyServiceInvoice.make-test-result-store');
    Route::get('radiologyServiceInvoice/make-test-result-show/{id}', [RadiologyServiceInvoiceController::class, 'showResult'])->name('radiologyServiceInvoice.make-test-result-show');
});

