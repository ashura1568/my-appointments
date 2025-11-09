<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
//use App\Http\Controllers\Controller;

//Public resources
Route::get('/specialties', [\App\Http\Controllers\Api\SpecialtyController::class, 'index']);
Route::get('/specialties/{specialty}/doctors', [\App\Http\Controllers\Api\SpecialtyController::class, 'doctors']);
Route::get('/schedule/hours', [\App\Http\Controllers\Api\ScheduleController::class, 'hours']);

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);

    //Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    

    Route::middleware('auth:api')->group(function () {
        Route::post('profile', [AuthController::class, 'profile']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
    });
});







