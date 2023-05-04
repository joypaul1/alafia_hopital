<?php

use App\Http\Controllers\Backend\Pathology\LabTestController;
use App\Http\Controllers\Backend\Pathology\LabTestResultController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'admin', 'prefix' =>'admin-pathology' ,'as'=>'backend.pathology.'],function(){

    Route::resource('labTest', LabTestController::class);
    Route::get('make-test-result', [LabTestResultController::class, 'create'])->name('make-test-result');
    Route::POST('make-test-result-store', [LabTestResultController::class, 'store'])->name('make-test-result-store');
    Route::get('make-test-result-show', [LabTestResultController::class, 'show'])->name('make-test-result-show');
    Route::get('print-cat-result', [LabTestResultController::class, 'printCat'])->name('printCat');
    Route::get('print-test/{labInvoice}', [LabTestResultController::class, 'printTest'])->name('printTest');
});
