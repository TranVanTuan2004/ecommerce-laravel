<?php

use App\Http\Controllers\Auth\AuthController;
use \App\Http\Controllers\Brand\BrandController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Cruduser\UserController;
use App\Http\Controllers\Home\HomeController;
use Illuminate\Support\Facades\Route;

// Client
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/cart', [CartController::class, 'index'])->name('cart');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::group([
    'prefix' => '/auth',
], function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('is_admin');


Route::group([
    'prefix' => '/dashboard/brands',
    'middleware' => 'is_admin'
], function () {
    Route::get('', [BrandController::class, 'index'])->name('brand.index');
    Route::get('/create', [BrandController::class, 'create'])->name('brand.create');
    Route::post('dashboard/brand', [BrandController::class, 'store'])->name('brand.store');
    Route::get('/{id}/edit', [BrandController::class, 'edit'])->name('brand.edit');
    Route::put('/{id}', [BrandController::class, 'update'])->name('brand.update');
    Route::delete('/{id}', [BrandController::class, 'destroy'])->name('brand.destroy');
});


Route::group([
    'prefix' => '/user',
], function () {

});

Route::group([
    'prefix' => '/dashboard/product',
], function () {

});

Route::group([
    'prefix' => '/dashboard/category',
], function () {

});




//hau chuc nang crud_user
Route::group([
    'prefix' => '/dashboard/users',
], function () {
    Route::get('', [UserController::class, 'index'])->name('users.index');
    Route::get('/create', [UserController::class, 'create'])->name('users.create');
    Route::post('dashboard/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});






