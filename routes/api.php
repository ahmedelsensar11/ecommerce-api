<?php

use App\Http\Controllers\Api\AuthController;
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
        Route::post('/verify-otp',[AuthController::class,'verify']);
        Route::get('/resend-otp',[AuthController::class,'resend']);
        Route::get('/logout',[AuthController::class,'logout']);
    });
});
