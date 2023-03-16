<?php
use App\Http\Controllers\Backend\Admin\AdminController;
use App\Http\Controllers\Backend\Admin\PersonalLockerController;
use App\Http\Controllers\Backend\Home\DashboardController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\Admin\PermissionController;
use App\Http\Controllers\Backend\Admin\RoleController;
use App\Http\Controllers\Backend\Admin\PermissionAssignController;
use App\Http\Controllers\Backend\Admin\ModuleController;
use App\Http\Controllers\Backend\Admin\SubmoduleController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'admin', 'prefix' =>'admin' , 'as'=>'backend.'], function(){
        // dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    // user
    Route::resource('user', UserController::class);
     // locker
    Route::resource('personal-locker', PersonalLockerController::class);
    Route::get('personal-locker-document/{id}', [PersonalLockerController::class, 'documentIndex'])->name('admin.locker.document');
    Route::Post('personal-locker-document/store/{personalLocker}', [PersonalLockerController::class, 'documentStore'])->name('admin.locker.document.store');

        // log-activity
    Route::get('log-activity', [AdminController::class, 'logIndex'])->name('admin.log.activity');
        // admin
    Route::resource('admin', AdminController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('permission-assign', PermissionAssignController::class);
    Route::resource('modules', ModuleController::class);
    Route::resource('submodules', SubmoduleController::class);




});
