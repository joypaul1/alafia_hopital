<?php

use App\Http\Controllers\Backend\Appointment\AppointmentController;
use App\Http\Controllers\Backend\Employee\DepartmentController;
use App\Http\Controllers\Backend\Employee\DesignationController;
use App\Http\Controllers\Backend\Employee\EmployeeController;
// use App\Http\Controllers\Backend\Employee\Employee\EmployeeController;
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
    Route::get('patientlist', [PatientController::class,'patientList'])->name('patientlist');;
    Route::get('addpatient', [PatientController::class,'addPatient'])->name('addpatient');;
    Route::post('savepatient', [PatientController::class,'savepatient'])->name('savepatient');;

});

