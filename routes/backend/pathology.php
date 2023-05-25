<?php

use App\Http\Controllers\Backend\Pathology\LabTestController;
use App\Http\Controllers\Backend\Pathology\LabTestResultController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'admin', 'prefix' =>'admin-pathology' ,'as'=>'backend.pathology.'],function(){

    Route::get('labTest-moveToMakeReport', [LabTestController::class, 'changeStatus'])->name('labTest.changeStatus');
    Route::get('payment/{id}', [LabTestController::class, 'payment'])->name('payment');
    Route::post('payment-store/{id}', [LabTestController::class, 'paymentStore'])->name('payment.store');
    Route::get('labTest-multiInvoice/{id}', [LabTestController::class, 'multiInvoice'])->name('payment.multiInvoice');
    Route::get('labTest-viewSlot', [LabTestController::class, 'viewSlot'])->name('labTest.viewSlot');
    Route::resource('labTest', LabTestController::class);
    Route::get('make-test-result', [LabTestResultController::class, 'create'])->name('make-test-result');
    Route::POST('make-test-result-store', [LabTestResultController::class, 'store'])->name('make-test-result-store');
    Route::POST('make-test-result-update', [LabTestResultController::class, 'update'])->name('make-test-result-update');
    Route::get('make-test-result-show', [LabTestResultController::class, 'show'])->name('make-test-result-show');
    Route::get('make-test-result-edit', [LabTestResultController::class, 'edit'])->name('make-test-result-edit');
    Route::get('print-cat-result', [LabTestResultController::class, 'printCat'])->name('printCat');
    Route::get('print-test/{labInvoice}', [LabTestResultController::class, 'printTest'])->name('printTest');
    Route::get('print-bar-code/{labInvoice}', [LabTestResultController::class, 'printBarCode'])->name('printBarCode');
});
