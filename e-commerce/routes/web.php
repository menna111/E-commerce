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
use App\Http\Controllers\Admin\subcategoryController;

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

//Route::get('/', function () {
//    return redirect()->route('home');
//});

Route::get('/test',[TestController::class,'test']);  //seeder
//Route::get('/',[HomeController::class,'index']);

Auth::routes();

//user view
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/category/show/{id}',[HomeController::class,'showcategory'])->name('category.show');
Route::get('/product/show/{id}',[HomeController::class,'showproduct'])->name('product.show');

//cart
Route::middleware('auth')->group(function (){

    Route::prefix('cart')->group(function () {

        Route::get('/',[CartController::class,'index'])->name('cart');
        Route::Post('/add',[CartController::class,'add'])->name('cart.add');
        Route::get('/delete/{id}',[CartController::class,'delete'])->name('cart.delete');
        Route::post('/update',[CartController::class,'update'])->name('cart.update');
    });

    //checkout
    Route::prefix('checkout')->group(function () {
    Route::get('/',[CheckoutController::class,'index'])->name('checkout');
    Route::post('placeorder',[checkoutController::class,'placeOrder'])->name('placeorder');
    });
});




//////// ///////////////////       admin /////////////////////////
 Route::middleware(['auth','admin'])->group(function(){
    Route::get('/dashboard',[FrontendController::class,'index'])->name('dashboard');

    //categories
     Route::prefix('category')->group(function () {

         Route::get('/',[CategoryController::class,'index'])->name('categories');
         Route::get('/add',[CategoryController::class,'add'])->name('category.add');
         Route::post('/store',[CategoryController::class,'store'])->name('category.store');
         Route::get('/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
         Route::post('/update/{id}',[CategoryController::class,'update'])->name('category.update');
         Route::get('/delete/{id}',[CategoryController::class,'delete'])->name('category.delete');
 });


     //sub_categories
     Route::prefix('sub_category')->group(function () {

         Route::get('/',[subcategoryController::class,'index'])->name('subcategories');
         Route::get('/add',[subcategoryController::class,'add'])->name('sub.add');
         Route::post('/store',[subcategoryController::class,'store'])->name('sub.store');
         Route::get('/edit/{id}',[subcategoryController::class,'edit'])->name('sub.edit');
         Route::post('/update/{id}',[subcategoryController::class,'update'])->name('sub.update');
         Route::get('/delete/{id}',[subcategoryController::class,'delete'])->name('sub.delete');



     });

    //products
     Route::prefix('product')->group(function () {

         Route::get('/',[ProductController::class,'index'])->name('products');
     Route::get('/add',[ProductController::class,'add'])->name('product.add');
     Route::post('/store',[ProductController::class,'store'])->name('product.store');
    Route::get('/edit/{id}',[ProductController::class,'edit'])->name('product.edit');
     Route::post('/update/{id}',[ProductController::class,'update'])->name('product.update');
     Route::get('/delete/{id}',[ProductController::class,'delete'])->name('product.delete');

     });


 });



//shop
Route::get('/shop',[ShopController::class,'index'])->name('shop');





//cart



Route::get('/contact',[ContactController::class,'index'])->name('contact');


//fatoorah payment

Route::get('callback',function (){
    return 'success';
});

Route::get('error',function (){
    return 'payment failed';
});


