<?php

use App\Http\Controllers\Auth\AuthController;
use \App\Http\Controllers\Brand\BrandController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Checkout\CheckoutController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Cruduser\UserController;
use App\Http\Controllers\Favorite\FavoriteController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\OrderControllerAdmin;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Top10Users\Top10UsersController;
use App\Http\Controllers\Voucher\VoucherController;
use App\Http\Controllers\Client\BlogClientController;
use App\Http\Controllers\Category\CategoryController;


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Order\OrderController;

// Client
Route::group([
    'prefix' => '/cart',
    'middleware' => 'is_login'
], function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/addToCart', [CartController::class, 'addToCart'])->name('cart.addToCart');
    Route::post('/increase/{productId}', [CartController::class, 'increase'])->name('cart.increase');
    Route::post('/decrease/{productId}', [CartController::class, 'decrease'])->name('cart.decrease');
    Route::delete('/destroy/{productId}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::delete('/clearAllCart', [CartController::class, 'clearAllCart'])->name('cart.clearAllCart');
});


Route::get('/shop', [HomeController::class, 'showProduct'])->name('product.shop');
Route::get('/shop', [HomeController::class, 'showProduct'])->name('product.shop');
Route::get('/category/{id}', [HomeController::class, 'showProduct'])->name('category.products');
Route::get('/', [HomeController::class, 'showProduct'])->name('homePage');
Route::get('/product/{id}', [HomeController::class, 'showProductDetail'])->name('productDetail');
// Client routes
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs');
Route::post('/send-message', [ChatController::class, 'sendMessage'])->name('send.message');
Route::get('/blogs', [BlogClientController::class, 'index'])->name('blogs');
Route::get('/blogs/{id}', [BlogClientController::class, 'show'])->name('blogs.show');





Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::group([
    'prefix' => '/checkout',
], function () {
    Route::post('/', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::get('/getAllVouchers', [CheckoutController::class, 'getAllVouchers'])->name('checkout.voucher');
    Route::post('/store', [CheckoutController::class, 'store'])->name('checkout.store');
});


Route::group([
    'prefix' => '/favorite',
    'middleware' => 'is_login'
], function () {
    Route::get('/', [FavoriteController::class, 'index'])->name('favorite.index');
    Route::post('/toggle', [FavoriteController::class, 'toggleFavorite'])->name('favorite.toggle');
});



Route::group([
    'prefix' => '/user',
], function () { });

Route::group([
    'prefix' => '/dashboard/product',
], function () { });

Route::group([
    'prefix' => '/dashboard/category',
], function () { });

Route::group([
    'prefix' => '/order',
    'middleware' => 'is_login'
], function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/order-status/{id}', [OrderController::class, 'getOrderStatus']);
    Route::post('/comment/{product_id}', [HomeController::class, 'storeReview'])->name('review.store');
    Route::patch('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
});


Route::group([
    'prefix' => '/dashboard/product',
], function () { });

Route::group([
    'prefix' => '/dashboard/category',
], function () { });





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


Route::post('/send-message', [ChatController::class, 'sendMessage'])->middleware('auth');
Route::get('/', [HomeController::class, 'showProduct'])->name('homePage');
Route::get('/product/{id}', [HomeController::class, 'showProductDetail'])->name('productDetail');

Route::group([
    'prefix' => '/auth',
], function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.show');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/verify-email/{token}', [AuthController::class, 'verifyEmail'])->name('verify.email');
});

Route::group(['prefix' => 'auth', 'middleware' => 'is_login'], function () {
    Route::get('/profile', [AuthController::class, 'showProfile'])->name('auth.profile');
    Route::put('/profile/update', [AuthController::class, 'update'])->name('auth.profile.update');
    Route::put('/profile/change-password', [AuthController::class, 'changePassword'])->name('auth.profile.changePassword');
    Route::post('/profile/upload-avatar', [AuthController::class, 'uploadAvatar'])->name('auth.profile.uploadAvatar');
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
        'prefix' => 'dashboard/blogs',
    ], function () {
        Route::get('', [BlogController::class, 'index'])->name('blog.index');
        Route::get('/create', [BlogController::class, 'create'])->name('blog.create');
        Route::post('', [BlogController::class, 'store'])->name('blog.store');
        Route::get('/{id}/edit', [BlogController::class, 'edit'])->name('blog.edit');
        Route::put('/{id}', [BlogController::class, 'update'])->name('blog.update');
        Route::delete('/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');
    });


    Route::group([
        'prefix' => '/dashboard/voucher',
    ], function () {
        Route::get('', [VoucherController::class, 'index'])->name('voucher.index');
        Route::get('/create', [VoucherController::class, 'create'])->name('voucher.create');
        Route::post('/store', [VoucherController::class, 'store'])->name('voucher.store');
        Route::get('/{id}/edit', [VoucherController::class, 'edit'])->name('voucher.edit');
        Route::put('/{id}', [VoucherController::class, 'update'])->name('voucher.update');
        Route::delete('/{id}', [VoucherController::class, 'destroy'])->name('voucher.destroy');
    });

    Route::group([
        'prefix' => '/dashboard/product',
    ], function () { });

    //Chức năng quản lí danh mục_Quynh
    Route::group([
        'prefix' => '/dashboard/category',
    ], function () {
        Route::get('', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
        Route::put('/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    });

    //Chức năng quản lí đơn hàng_Quynh
    Route::group([
        'prefix' => '/dashboard/order',
    ], function () {
        Route::get('', [OrderControllerAdmin::class, 'index'])->name('order.index');
        Route::get('{id}/show', [OrderControllerAdmin::class, 'show'])->name('order.show');
        Route::get('{id}/edit', [OrderControllerAdmin::class, 'edit'])->name('order.edit');
        Route::put('{id}/update-status', [OrderControllerAdmin::class, 'updateStatus'])->name('order.updateStatus');
        Route::put('/order/{id}/cancel', [OrderControllerAdmin::class, 'cancel'])->name('order.cancel');
        Route::delete('{id}', [OrderControllerAdmin::class, 'destroy'])->name('order.destroy');
    });

    Route::group([
        'prefix' => '/dashboard/category',
    ], function () { });

    //Route danh cho top10
    Route::group(['prefix' => '/dashboard/top10'], function () {
        Route::get('/show', [Top10UsersController::class, 'showTopUsers'])->name('topusers.show');
    });
});
