<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\contactController;
use App\Http\Controllers\checkoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\shopController;

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

Route::get('/home', [HomeController::class, 'index'])->name('home');


//shop
Route::get('/shop',[ShopController::class,'index'])->name('shop');


//checkout
Route::get('/checkout',[CheckoutController::class,'index'])->name('checkout');


//cart
Route::get('/cart',[CartController::class,'index'])->name('cart');



Route::get('/contact',[ContactController::class,'index'])->name('contact');
