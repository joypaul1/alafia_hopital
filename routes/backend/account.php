<?php

use App\Http\Controllers\Account\AccountGroupController;
use App\Http\Controllers\Account\AccountLedgerController;
use App\Http\Controllers\Backend\TransactionController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'admin', 'prefix' =>'admin' , 'as'=>'backend.account.'], function(){

    Route::resource('accountgroup', AccountGroupController::class);
    Route::resource('accountledger', AccountLedgerController::class);
    Route::resource('transaction', TransactionController::class);

});
