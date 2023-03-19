<?php

use App\Http\Controllers\Backend\Prescription\PrescriptionController;

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'admin', 'prefix' =>'admin-pathology' ,'as'=>'backend.pathology.'],function(){

    Route::resource('labTest', PrescriptionController::class);
});
