<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('admin')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('login.submit');
    
    Route::middleware('admin')->group(function () {
        Route::get('dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
        Route::resource('products', ProductController::class);
        Route::get('product/{id}/variants', [ProductController::class, 'variants'])->name('product.variants');
        Route::post('product/{id}/variants', [ProductController::class, 'variantsStore'])->name('product.variants.store');

    });
});

Route::get('/', function () {
    return redirect()->route('admin.login');
});