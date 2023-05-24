<?php

use App\Http\Controllers\Backend\Prescription\PrescriptionController;

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'admin', 'prefix' =>'admin' ,'as'=>'backend.'],function(){

    Route::get('doctor-searchTest', [PrescriptionController::class, 'searchTest'])->name('doctor.searchTest');
    Route::resource('prescription', PrescriptionController::class);


});
