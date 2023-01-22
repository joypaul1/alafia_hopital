<?php

use App\Http\Controllers\Backend\SiteConfig\BarcodeController;
use App\Http\Controllers\Backend\File\FileManagerController;
use App\Http\Controllers\Backend\SiteConfig\PrefixController;
use App\Http\Controllers\Backend\SiteConfig\BannerController;
use App\Http\Controllers\Backend\SiteConfig\EmailConfigurationController;
use App\Http\Controllers\Backend\SiteConfig\MetatagController;
use App\Http\Controllers\Backend\SiteConfig\QuickPageController;
use App\Http\Controllers\Backend\SiteConfig\SiteInfoController;
use App\Http\Controllers\Backend\SiteConfig\SliderController;
use App\Http\Controllers\Backend\SiteConfig\SocialMediaController;
use App\Http\Controllers\Backend\SiteConfig\TaxController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'admin', 'prefix' =>'admin/site-config' , 'as'=>'backend.siteconfig.'], function(){

        // site-config
    Route::get('/', [SiteInfoController::class, 'index'])->name('index');;
    Route::POST('/update', [SiteInfoController::class, 'update'])->name('update');

    // socialmedia
    Route::resource('socialmedia', SocialMediaController::class);

    // slider
    Route::resource('slider', SliderController::class);
        // banner
    Route::resource('banner', BannerController::class);
        // quick-page
    Route::resource('quick-page', QuickPageController::class);

        // Email-Configuration
    Route::resource('email-configuration', EmailConfigurationController::class);

        // Meta-tag-Configuration
    Route::resource('meta-tag', MetatagController::class);
        
        // Barcode-method
    Route::resource('barcode-method', BarcodeController::class);
        // prefix-system
    Route::resource('prefix-system', PrefixController::class);
        
    // tax-rate
    Route::resource('tax-rate', TaxController::class);
    
        // filemanager-Configuration
    Route::get('filemanager', [FileManagerController::class, 'index'])->name('filemanager');


      
});