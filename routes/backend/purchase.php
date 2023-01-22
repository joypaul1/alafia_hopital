<?php

use App\Http\Controllers\Backend\Purchase\PurchaseController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'admin', 'prefix' =>'admin' , 'as'=>'backend.'], function(){

    Route::resource('purchase', PurchaseController::class);


});