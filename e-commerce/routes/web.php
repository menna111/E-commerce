<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\contactController;
use App\Http\Controllers\checkoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\shopController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\FrontendController;
use App\Http\Controllers\Admin\CategoryController;

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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();


 Route::middleware(['auth','admin'])->group(function(){
    Route::get('/dashboard',[FrontendController::class,'index'])->name('dashboard');
     Route::get('categories',[CategoryController::class,'index'])->name('categories');



 });

Route::get('/home', [HomeController::class, 'index'])->name('home');


//shop
Route::get('/shop',[ShopController::class,'index'])->name('shop');


//checkout
Route::get('/checkout',[CheckoutController::class,'index'])->name('checkout');


//cart
Route::get('/cart',[CartController::class,'index'])->name('cart');



Route::get('/contact',[ContactController::class,'index'])->name('contact');
