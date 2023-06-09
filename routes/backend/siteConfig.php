<?php

use App\Http\Controllers\Backend\Bed\BedCabinController;
use App\Http\Controllers\Backend\Bed\BedController;
use App\Http\Controllers\Backend\Bed\BedGroupController;
use App\Http\Controllers\Backend\Bed\BedTypeController;
use App\Http\Controllers\Backend\Bed\BedWardController;
use App\Http\Controllers\Backend\Bed\FloorController;
use App\Http\Controllers\Backend\SiteConfig\BarcodeController;
use App\Http\Controllers\Backend\File\FileManagerController;
use App\Http\Controllers\Backend\SiteConfig\Lab\LabTestController;
use App\Http\Controllers\Backend\SiteConfig\Lab\LabTestTubeController;
use App\Http\Controllers\Backend\SiteConfig\PrefixController;
use App\Http\Controllers\Backend\SiteConfig\BannerController;
use App\Http\Controllers\Backend\SiteConfig\Blood\BloodBankController;
use App\Http\Controllers\Backend\SiteConfig\Blood\BloodBankTypeController;
use App\Http\Controllers\Backend\SiteConfig\EmailConfigurationController;
use App\Http\Controllers\Backend\SiteConfig\MetaTagController;
use App\Http\Controllers\Backend\SiteConfig\QuickPageController;
use App\Http\Controllers\Backend\SiteConfig\Service\RadiologyController;
use App\Http\Controllers\Backend\SiteConfig\Service\ServiceNameController;
use App\Http\Controllers\Backend\SiteConfig\Service\ServiceTypeController;
use App\Http\Controllers\Backend\SiteConfig\SiteInfoController;
use App\Http\Controllers\Backend\SiteConfig\SliderController;
use App\Http\Controllers\Backend\SiteConfig\SocialMediaController;
use App\Http\Controllers\Backend\SiteConfig\TaxController;
use App\Http\Controllers\Backend\SiteConfig\Symptom\SymptomTypeController;
use App\Http\Controllers\Backend\SiteConfig\Symptom\SymptomController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'admin', 'prefix' => 'admin/site-config', 'as' => 'backend.siteConfig.'], function () {

    // site-config
    Route::get('/', [SiteInfoController::class, 'index'])->name('index');

    Route::POST('/update', [SiteInfoController::class, 'update'])->name('update');

    // socialMedia
    Route::resource('socialMedia', SocialMediaController::class);

    // slider
    Route::resource('slider', SliderController::class);
    // banner
    Route::resource('banner', BannerController::class);
    // quick-page
    Route::resource('quick-page', QuickPageController::class);

    // Email-Configuration
    Route::resource('email-configuration', EmailConfigurationController::class);

    // Meta-tag-Configuration
    Route::resource('meta-tag', MetaTagController::class);

    // Barcode-method
    Route::resource('barcode-method', BarcodeController::class);
    // prefix-system
    Route::resource('prefix-system', PrefixController::class);

    // tax-rate
    Route::resource('tax-rate', TaxController::class);

    //bed
    Route::resource('bed', BedController::class);

    //bedGroup
    Route::resource('bedGroup', BedGroupController::class);

    //bedType
    Route::resource('bedType', BedTypeController::class);

    //floor
    Route::resource('floor', FloorController::class);

    //cabin
    Route::resource('bedCabin', BedCabinController::class);

    //bedWard
    Route::resource('bedWard', BedWardController::class);

    //symptomsType
    Route::resource('symptomType', SymptomTypeController::class);

    //symptoms
    Route::resource('symptom', SymptomController::class);

    //serviceType
    Route::resource('serviceType', ServiceTypeController::class);

    //service
    Route::resource('serviceName', ServiceNameController::class);

    //radiology
    Route::resource('radiology_serviceName', RadiologyController::class);

    //labTest
    Route::resource('labTest', LabTestController::class);


    //LabTestTube
    Route::resource('labTestTube', LabTestTubeController::class);

    //blood
    Route::resource('bloodBank', BloodBankController::class);


    //bloodType
    Route::resource('bloodBankType', BloodBankTypeController::class);

    // filemanager-Configuration
    Route::get('filemanager', [FileManagerController::class, 'index'])->name('filemanager');
});
