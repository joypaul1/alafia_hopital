<?php

use App\Http\Controllers\Backend\Payment\DoctorAppointmentPaymentController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'admin', 'prefix' =>'admin-payment' , 'as'=>'backend.payment'], function(){
    // doctor
    Route::resource('doctor', DoctorAppointmentPaymentController::class);
});
