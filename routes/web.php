<?php

use \App\Http\Controllers\Brand\BrandController;
use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::group([
    'prefix' => '/brand',
], function () {
    Route::get('', [BrandController::class, 'index'])->name('brand.index');
    Route::get('/create', [BrandController::class, 'create'])->name('brand.create');
    Route::post('dashboard/brand', [BrandController::class, 'store'])->name('brand.store');
    Route::get('/{id}/edit', [BrandController::class, 'edit'])->name('brand.edit');
    Route::put('/{id}', [BrandController::class, 'update'])->name('brand.update');
    Route::delete('/{id}', [BrandController::class, 'destroy'])->name('brand.destroy');
});


Route::group([
    'prefix' => '/dashboard/user',
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