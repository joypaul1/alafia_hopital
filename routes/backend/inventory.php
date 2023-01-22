<?php

use App\Http\Controllers\Inventory\WareHouseController;
use App\Http\Controllers\Inventory\InventoryController;
use App\Http\Controllers\Inventory\StockTransferController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'admin', 'prefix' =>'admin' , 'as'=>'backend.inventory.'], function(){

    // warehouse
    Route::resource('warehouse', WareHouseController::class);
    // inventory
    Route::resource('inventoryitem', InventoryController::class);
    // stock-transfer
    Route::resource('stock-transfer', StockTransferController::class);
});
