<?php

use App\Http\Controllers\Backend\Contact\CustomerController;
use App\Http\Controllers\Backend\Contact\SupplierController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'admin', 'prefix' =>'admin' , 'as'=>'backend.'], function(){
    // Supplier
    Route::resource('supplier', SupplierController::class);
    // customer
    Route::resource('customer', CustomerController::class);
});
