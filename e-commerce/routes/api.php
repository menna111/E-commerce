<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FatoorahController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\checkoutController;
use App\Http\Controllers\CartController;

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

Route::get('/cart',[\App\Http\Controllers\Api\CartController::class,'index'])->name('cart')->middleware('token.auth');
