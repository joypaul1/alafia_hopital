<?php

use App\Http\Controllers\Backend\Production\ProductionController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'admin', 'prefix' =>'admin' , 'as'=>'backend.'], function(){

    Route::resource('production', ProductionController::class);

});
