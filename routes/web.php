<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/register', function () {
    return redirect('/home');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/products', [App\Http\Controllers\HomeController::class, 'index_products'])->name('index_products');
Route::get('/users', [App\Http\Controllers\HomeController::class, 'index_users'])->name('index_users');


Route::group(['prefix' => 'get'], function () {
    Route::get('/products', [App\Http\Controllers\HomeController::class, 'get_products']);
    Route::get('/users', [App\Http\Controllers\HomeController::class, 'get_users']);
});