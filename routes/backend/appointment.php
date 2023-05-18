<?php

use App\Http\Controllers\Backend\Appointment\AppointmentController;
use App\Http\Controllers\Backend\Appointment\DialysisAppointmentController;
use App\Http\Controllers\Backend\Radiology\RadiologyServiceInvoiceController;
use Illuminate\Support\Facades\Route;

// Doctor appointment
Route::group(['middleware' => 'admin', 'prefix' =>'admin' , 'as'=>'backend.'], function(){
    Route::get('appointment-prescription/{id}', [AppointmentController::class, 'prescriptionPad'])->name('appointment.prescription');
    Route::resource('appointment', AppointmentController::class);
});

// dailyses appointment
Route::group(['middleware' => 'admin', 'prefix' =>'admin' , 'as'=>'backend.'], function(){
    Route::resource('dialysis-appointment', DialysisAppointmentController::class);
    Route::get('dialysis-service-invoice', [DialysisAppointmentController::class, 'serviceInvoice'])->name('dialysis.service.invoice');

});
// radiologyServiceInvoice
Route::group(['middleware' => 'admin', 'prefix' =>'admin' , 'as'=>'backend.'], function(){
    Route::resource('radiologyServiceInvoice', RadiologyServiceInvoiceController::class);

    Route::get('payment/{id}', [RadiologyServiceInvoiceController::class, 'payment'])->name('radiology.payment');
    Route::post('payment-store/{id}', [RadiologyServiceInvoiceController::class, 'paymentStore'])->name('radiology.payment.store');
    Route::get('labTest-multiInvoice/{id}', [RadiologyServiceInvoiceController::class, 'multiInvoice'])->name('radiology.payment.multiInvoice');

    Route::get('radiologyServiceInvoice/make-test-result/{id}', [RadiologyServiceInvoiceController::class, 'makeResult'])->name('radiologyServiceInvoice.make-test-result');
    Route::post('radiologyServiceInvoice/make-test-result-store/{id}', [RadiologyServiceInvoiceController::class, 'storeResult'])->name('radiologyServiceInvoice.make-test-result-store');
    Route::get('radiologyServiceInvoice/make-test-result-show/{id}', [RadiologyServiceInvoiceController::class, 'showResult'])->name('radiologyServiceInvoice.make-test-result-show');
});

