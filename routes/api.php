<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group( function () {
    Route::apiResource('/products', App\Http\Controllers\Api\ProductController::class);
    Route::post('/users-password', [App\Http\Controllers\Api\UserController::class, 'update_password']);
    Route::post('/logout', [App\Http\Controllers\Api\UserController::class, 'logout']);
});

//users
Route::apiResource('/users', App\Http\Controllers\Api\UserController::class);
Route::post('/login', [App\Http\Controllers\Api\UserController::class, 'login']);

Route::apiResource('/shop_types', App\Http\Controllers\Api\ShopTypeController::class);
Route::apiResource('/shop_locations', App\Http\Controllers\Api\ShopLocationController::class);