<?php

use App\Http\Controllers\Backend\Order\DeliveredController;
use App\Http\Controllers\Backend\Order\PendingController;
use App\Http\Controllers\Backend\Order\ProcessingController;
use App\Http\Controllers\Backend\OrderController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'admin', 'prefix' =>'admin' , 'as'=>'backend.order.'], function(){

    // order-list
    Route::resource('order-list-pending', PendingController::class);
    Route::resource('order-list-processing', ProcessingController::class);
    Route::resource('order-list-delivered', DeliveredController::class);
    Route::resource('order-list', OrderController::class);

});
