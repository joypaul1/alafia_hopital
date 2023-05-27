<?php

use App\Http\Controllers\Backend\Employee\DepartmentController;
use App\Http\Controllers\Backend\Employee\DesignationController;
use App\Http\Controllers\Backend\Employee\EmployeeController;
use App\Http\Controllers\Backend\Employee\ShiftController;
use App\Http\Controllers\Backend\Patient\PatientController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'admin', 'prefix' =>'admin' , 'as'=>'backend.'], function(){

    Route::group(['as'=>'employee.'], function(){
        Route::resource('designation', DesignationController::class);
        Route::resource('department', DepartmentController::class);
        Route::resource('shift', ShiftController::class);
    });
    Route::resource('employee', EmployeeController::class);


});
// patient
Route::group(['middleware' => 'admin', 'prefix' =>'admin' , 'as'=>'backend.'], function(){
    Route::resource('patient', PatientController::class);
    Route::get('patient-history/{id}',[PatientController::class, 'history'])->name('patient.history');
    Route::get('patient-list', [PatientController::class,'patientList'])->name('patient.list');;
    Route::get('add-patient', [PatientController::class,'addPatient'])->name('patient.add');;
    Route::post('save-patient', [PatientController::class,'savePatient'])->name('patient.save');
});

