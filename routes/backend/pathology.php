<?php

use App\Http\Controllers\Backend\Pathology\LabTestController;
use App\Http\Controllers\Backend\Pathology\LabTestResultController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'admin', 'prefix' =>'admin-pathology' ,'as'=>'backend.pathology.'],function(){

    Route::resource('labTest', LabTestController::class);
    Route::get('make-test-result', [LabTestResultController::class, 'makeResult'])->name('make-test-result');
});
