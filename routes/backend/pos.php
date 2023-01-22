<?php

use App\Http\Controllers\Backend\Pos\OutletController;
use App\Http\Controllers\Backend\Pos\PosController;
use App\Http\Controllers\Backend\Pos\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Backend\Pos\Create;
use App\Http\Livewire\Backend\Pos\Edit;

Route::group(['middleware' => 'admin', 'prefix' =>'admin/pos' , 'as'=>'backend.'], function(){

    Route::get('pos', Create::class)->name('pos.index');
    Route::get('pos-edit/{order_id}', Edit::class)->name('pos.edit');
    Route::resource('pos-pdf', PosController::class);
    Route::resource('outlet', OutletController::class);
    Route::resource('register', RegisterController::class);

});
