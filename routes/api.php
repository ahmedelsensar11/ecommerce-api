<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StoreController;
use Illuminate\Support\Facades\Route;


/**
 * Public Routes
 */

//auth
Route::prefix('auth')->group(function (){
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[AuthController::class,'login']);
});


/**
 * Protected Routes
 */

Route::middleware('auth:sanctum')->group(function (){
    //auth
    Route::prefix('auth')->group(function (){
        Route::get('/logout',[AuthController::class,'logout']);
    });
    //merchant requests
    Route::middleware('merchant')->group(function (){
        Route::prefix('store')->group(function (){
            Route::post('/set-store-name',[StoreController::class,'setStoreName']);
            Route::post('/update-vat-status',[StoreController::class,'updateVatStatus']);
            Route::post('/set-shipping-cost',[StoreController::class,'setShippingCost']);
            Route::post('/set-vat-percentage',[StoreController::class,'setVatPercentage']);
        });
    });
});
