<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', [])

Route::group([
    'prefix' => '/dashboard/brand',
], function () {

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