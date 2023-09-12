<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('products/{id?}', [ProductController::class, 'getProducts']);

Route::get('cart/{id?}', [CartController::class, 'getCartList']);
Route::post('add_update_cart', [CartController::class, 'addOrUpdateCart']);
Route::post('delete_cart', [CartController::class, 'deleteCart']);

Route::post('sign_up', [UserController::class , 'signUpUser']);
Route::post('login', [UserController::class , 'loginUser']);
Route::post('logout', [UserController::class , 'logoutUser']);