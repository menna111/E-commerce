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
use App\Http\Controllers\Admin\ProductController;

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

    //categories
     Route::get('categories',[CategoryController::class,'index'])->name('categories');
     Route::get('category/add',[CategoryController::class,'add'])->name('category.add');
     Route::post('category/store',[CategoryController::class,'store'])->name('category.store');
     Route::get('category/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
     Route::post('category/update/{id}',[CategoryController::class,'update'])->name('category.update');
     Route::get('category/delete/{id}',[CategoryController::class,'delete'])->name('category.delete');


    //products
     Route::get('products',[ProductController::class,'index'])->name('products');
     Route::get('product/add',[ProductController::class,'add'])->name('product.add');
     Route::post('product/store',[ProductController::class,'store'])->name('product.store');
    Route::get('product/edit/{id}',[ProductController::class,'edit'])->name('product.edit');
     Route::post('product/update/{id}',[ProductController::class,'update'])->name('product.update');
     Route::get('product/delete/{id}',[ProductController::class,'delete'])->name('product.delete');



 });

Route::get('/home', [HomeController::class, 'index'])->name('home');


//shop
Route::get('/shop',[ShopController::class,'index'])->name('shop');


//checkout
Route::get('/checkout',[CheckoutController::class,'index'])->name('checkout');


//cart
Route::get('/cart',[CartController::class,'index'])->name('cart');



Route::get('/contact',[ContactController::class,'index'])->name('contact');
