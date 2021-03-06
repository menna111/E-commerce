<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FatoorahController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\checkoutController;
use App\Http\Controllers\Api\CartController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/login', [AuthController::class,'login']);
Route::post('/register',  [AuthController::class,'register']);

Route::post('/pay',[FatoorahController::class,'payOrder'])->middleware('token.auth');
//Route::post('placeorder',[checkoutController::class,'placeOrder'])->name('placeorder')->middleware('token.auth');
Route::middleware('token.auth')->group(function(){
Route::get('/cart',[CartController::class,'index'])->name('cart');
Route::Post('/add',[CartController::class,'add'])->name('cart.add');
});

Route::get('/categories',[\App\Http\Controllers\Api\HomeController::class,'categories']);
Route::get('/subcategories',[\App\Http\Controllers\Api\HomeController::class,'subcategories']);
Route::get('/products',[\App\Http\Controllers\Api\HomeController::class,'products']);


