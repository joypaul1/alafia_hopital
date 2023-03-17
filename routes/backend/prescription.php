<?php

use App\Http\Controllers\Backend\Prescription\PrescriptionController;

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'admin', 'prefix' =>'admin' ,'as'=>'backend.'],function(){

    Route::resource('prescription', PrescriptionController::class);


});
