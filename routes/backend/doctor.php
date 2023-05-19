<?php

use App\Http\Controllers\Backend\Doctor\DoctorController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'admin', 'prefix' =>'admin' , 'as'=>'backend.'], function(){

    Route::resource('doctor', DoctorController::class);
        Route::get('doctorlist', [DoctorController::class,'doctorlist'])->name('doctorlist');;


});
