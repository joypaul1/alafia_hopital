<?php

use App\Http\Controllers\Backend\Item\BrandController;
use App\Http\Controllers\Backend\Item\CategoryController;
use App\Http\Controllers\Backend\Item\ChildcategoryController;
use App\Http\Controllers\Backend\Item\ColorController;
use App\Http\Controllers\Backend\Item\ItemController;
use App\Http\Controllers\Backend\Item\RackController;
use App\Http\Controllers\Backend\Item\RowController;
use App\Http\Controllers\Backend\Item\SizeController;
use App\Http\Controllers\Backend\Item\StrenghtController;
use App\Http\Controllers\Backend\Item\SubcategoryController;
use App\Http\Controllers\Backend\Item\UnitController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'admin', 'prefix' =>'admin/item-config' , 'as'=>'backend.itemconfig.'], function(){

    // category
    Route::resource('category', CategoryController::class);
    // subcategory
    Route::get('subcategory/ajaxData', [SubcategoryController::class, 'ajaxData'])->name('subcategory.ajaxData');
    Route::resource('subcategory', SubcategoryController::class);
    // childcategory
    Route::resource('childcategory', ChildcategoryController::class);
    // manufacturer
    Route::resource('generic-name', ChildcategoryController::class);
     // brand
    Route::resource('brand', BrandController::class);
        // color
    Route::resource('color', ColorController::class);
        // size
    Route::resource('size', SizeController::class);
        // unit
    Route::resource('unit', UnitController::class);
        // rack
    Route::resource('rack', RackController::class);
        // row
    Route::resource('row', RowController::class);
        // strenght
    Route::resource('strenght', StrenghtController::class);
        // item
    Route::resource('item', ItemController::class);

    Route::get('getAjax-itemInfo', [ItemController::class, 'itemInfo'])->name('getAjax.itemInfo');
    Route::get('getPos-itemInfo', [ItemController::class, 'itemPosInfo'])->name('getPos.itemInfo');
});
