<?php

use App\Http\Controllers\Auth\Backend\LoginController;
use Illuminate\Support\Facades\Route;



// Route::group(['middleware' => 'admin'], function(){

    Route::get('admin-login', [LoginController::class, 'showLoginForm'])->name('backend.login.form');
    Route::Post('admin-login',[LoginController::class, 'login'])->name('backend.admin.login');
    Route::Post('admin-logout',[LoginController::class, 'logout'])->name('backend.admin.logout');

// });
require_once __DIR__ . '/dashboard.php';
require_once __DIR__ . '/siteConfig.php';
require_once __DIR__ . '/itemconfig.php';
require_once __DIR__ . '/employee.php';
require_once __DIR__ . '/contact.php';
require_once __DIR__ . '/pos.php';
require_once __DIR__ . '/inventory.php';
require_once __DIR__ . '/purchase.php';
require_once __DIR__ . '/account.php';
require_once __DIR__ . '/report.php';
require_once __DIR__ . '/order.php';
require_once __DIR__ . '/doctor.php';
require_once __DIR__ . '/prescription.php';
require_once __DIR__ . '/appointment.php';

