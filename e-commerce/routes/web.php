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
use App\Http\Controllers\TestController;

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

Route::get('/test',[TestController::class,'test']);
//Route::get('/',[HomeController::class,'index']);

Auth::routes();

//user view
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/category/show/{id}',[HomeController::class,'showcategory'])->name('category.show');
Route::get('/product/show/{id}',[HomeController::class,'showproduct'])->name('product.show');

//cart
Route::middleware('auth')->group(function (){
    Route::Post('/cart/add',[CartController::class,'add'])->name('cart.add');
    Route::get('/cart',[CartController::class,'index'])->name('cart');
    Route::get('/cart/delete/{id}',[CartController::class,'delete'])->name('cart.delete');
    Route::post('/cart/update',[CartController::class,'update'])->name('cart.update');

    //checkout
    Route::prefix('admin')->group(function () {
    Route::get('/',[CheckoutController::class,'index'])->name('checkout');
    Route::post('placeorder',[checkoutController::class,'placeOrder'])->name('placeorder');
    });
});

//////// ///////////////////       admin /////////////////////////
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



//shop
Route::get('/shop',[ShopController::class,'index'])->name('shop');





//cart
Route::get('/cart',[CartController::class,'index'])->name('cart');



Route::get('/contact',[ContactController::class,'index'])->name('contact');
