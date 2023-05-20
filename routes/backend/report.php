<?php

use App\Http\Controllers\Backend\Contact\SupplierController;
use App\Http\Controllers\Backend\Item\ItemController;
use App\Http\Controllers\Backend\Report\ReportController;
use App\Http\Controllers\Backend\TransactionController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'as' => 'backend.report.'], function () {

    Route::get('supplier-ledger', [SupplierController::class, 'ledgerReport'])->name('supplierledgerReport');
    Route::get('day-book', [ReportController::class, 'dayBook'])->name('dayBook');
    Route::get('cash-flow', [ReportController::class, 'cashFlow'])->name('cashFlow');
    Route::get('item-count', [ItemController::class, 'itemCount'])->name('itemCount');
    Route::get('sell-report', [ReportController::class, 'sellReport'])->name('sellReport');
    Route::get('purchase-report', [ReportController::class, 'purchaseReport'])->name('purchaseReport');
    Route::get('income-report', [ReportController::class, 'incomeReport'])->name('incomeReport');
    Route::get('expense-report', [ReportController::class, 'expenseReport'])->name('expenseReport');
    Route::get('profit-report', [ReportController::class, 'profitReport'])->name('profitReport');
    Route::get('doctor-wise-patient-visit', [ReportController::class, 'patientVisit'])->name('doctorWisePatientVisit');
});
