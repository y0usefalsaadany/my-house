<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLoginController;
Route::group([
    'middleware' => 'api',
    'prefix' => 'admin'
], function ($router) {
    Route::post('/login', [AdminLoginController::class, 'login'])->middleware('throttle:attack');
    Route::post('/register', [AdminLoginController::class, 'register']);
    Route::post('/logout', [AdminLoginController::class, 'logout']);
    // Route::post('/refresh', [AdminLoginController::class, 'refresh']);
    // Route::post('/updatePassword', [AdminLoginController::class, 'refresh']);
    Route::get('/user-profile', [AdminLoginController::class, 'userProfile']);
});
