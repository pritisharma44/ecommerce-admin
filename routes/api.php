<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\WebProductController;
use App\Http\Controllers\Api\CartController;

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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

// Product Managemeent Routes
Route::get('get-products', [WebProductController::class, 'getProducts']);
Route::get('view-product-details/{id}', [WebProductController::class, 'viewProductDetails']);

Route::middleware('auth:api')->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::post('add-to-cart', [CartController::class, 'addToCart']);
    Route::get('carts', [CartController::class, 'listCart']);
    Route::delete('remove-cart/{id}', [CartController::class, 'removeFromCart']);
});

