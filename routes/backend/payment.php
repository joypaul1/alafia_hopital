<?php

use App\Http\Controllers\Backend\Payment\DoctorAppointmentPaymentController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'admin', 'prefix' =>'admin-payment' , 'as'=>'backend.payment'], function(){
    // doctor
    Route::get('doctor-payment', [DoctorAppointmentPaymentController::class,'invoice'])->name('doctor_invoice');
    Route::resource('doctor', DoctorAppointmentPaymentController::class);
});
