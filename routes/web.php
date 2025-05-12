<?php

use App\Http\Controllers\Auth\AuthController;
use \App\Http\Controllers\Brand\BrandController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Checkout\CheckoutController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Cruduser\UserController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Voucher\VoucherController;
use Illuminate\Support\Facades\Route;

// Client
Route::group([
    'prefix' => '/cart',
], function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/addToCart', [CartController::class, 'addToCart'])->name('cart.addToCart');
    Route::post('/increase/{productId}', [CartController::class, 'increase'])->name('cart.increase');
    Route::post('/decrease/{productId}', [CartController::class, 'decrease'])->name('cart.decrease');
    Route::delete('/destroy/{productId}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::delete('/clearAllCart', [CartController::class, 'clearAllCart'])->name('cart.clearAllCart');
});

Route::group([
    'prefix' => '/checkout',
], function () {
    Route::post('/', [CheckoutController::class, 'index'])->name('checkout.index');
});



Route::get('/', [HomeController::class, 'showProduct'])->name('homePage');
Route::get('/product/{id}', [HomeController::class, 'showProductDetail'])->name('productDetail');
Route::post('/comment/{product_id}/{user_id}', [HomeController::class, 'storeReview'])->name('review.store');

Route::group([
    'prefix' => '/auth',
], function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group([
    'prefix' => '',
    'middleware' => 'is_admin'
], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('is_admin');

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



    Route::group([
        'prefix' => '/dashboard/brands',
    ], function () {
        Route::get('', [BrandController::class, 'index'])->name('brand.index');
        Route::get('/create', [BrandController::class, 'create'])->name('brand.create');
        Route::post('dashboard/brand', [BrandController::class, 'store'])->name('brand.store');
        Route::get('/{id}/edit', [BrandController::class, 'edit'])->name('brand.edit');
        Route::put('/{id}', [BrandController::class, 'update'])->name('brand.update');
        Route::delete('/{id}', [BrandController::class, 'destroy'])->name('brand.destroy');
    });


    Route::group([
        'prefix' => '/dashboard/voucher',
    ], function () {
        Route::get('', [VoucherController::class, 'index'])->name('voucher.index');
        Route::get('/create', [VoucherController::class, 'create'])->name('voucher.create');
        Route::post('/store', [VoucherController::class, 'store'])->name('voucher.store');
    });

    Route::group([
        'prefix' => '/dashboard/product',
    ], function () {

    });

    Route::group([
        'prefix' => '/dashboard/category',
    ], function () {

    });

});












