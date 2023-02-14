<?php

use App\Http\Controllers\Backend\FileManagerController;
use App\Http\Controllers\Backend\Event\FullCalenderController;
use App\Http\Controllers\Frontend\Cart\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Livewire\Frontend\Page\Category;
use App\Http\Livewire\Frontend\Page\Childcategory;
use App\Http\Livewire\Frontend\Page\Subcategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Backend\LoginController;
use App\Models\Item\Item;
use App\Models\Order;
use Termwind\Components\Dd;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Auth::routes();
// dd(Auth::guard('admin')->user());

Route::get('/',[LoginController::class, 'showLoginForm'])->name('home');
// Route::get('random-product',[HomeController::class, 'randomProduct'])->name('randomProduct');
// Route::get('category',Category::class)->name('category');
// Route::get('subcategory',Subcategory::class)->name('subcategory');
// Route::get('childcategory',Childcategory::class)->name('childcategory');
// Route::get('cart',[HomeController::class, 'cart'])->name('cart');
// Route::get('add-to-cart',[CartController::class, 'addCart'])->name('addCart')->middleware('auth');
// Route::get('delete-to-cart',[CartController::class, 'deleteCart'])->name('deleteCart')->middleware('auth');
// Route::get('user-login',[HomeController::class, 'login'])->name('user_login');
// Route::get('user-register',[HomeController::class, 'register'])->name('user_register');
// Route::get('item',[HomeController::class, 'item'])->name('item');
// Route::get('checkout',[HomeController::class, 'checkout'])->name('checkout');
// Route::post('order',[CheckoutController::class, 'order'])->name('order');
// Route::get('shop',[HomeController::class, 'shop'])->name('shop');
// Route::get('quick-view',[HomeController::class, 'quickPage'])->name('quickPage');
// Route::get('contact-us',[HomeController::class, 'contact'])->name('contact');
// Route::get('logout', function(){
//     Auth::logout();
//     return back();
// });

// Route::get('full-calender', [FullCalenderController::class, 'index']);
// Route::post('full-calender/action', [FullCalenderController::class, 'action']);

// Route::get('pdfView', [HomeController::class, 'pdfView'])->name('pdfView');


