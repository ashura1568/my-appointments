<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
//use App\Http\Controllers\Controller;
//use App\Http\Controllers\Api\AppointmentController;

//Route::post('/login', 'AuthController@login');
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
//Route::post('/register', 'AuthController@register');
Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);


//Public resources
Route::get('/specialties', [\App\Http\Controllers\Api\SpecialtyController::class, 'index']);
Route::get('/specialties/{specialty}/doctors', [\App\Http\Controllers\Api\SpecialtyController::class, 'doctors']);
Route::get('/schedule/hours', [\App\Http\Controllers\Api\ScheduleController::class, 'hours']);

Route::middleware('auth:api')->group(function () {

//Route::get('/user', [\App\Http\Controllers\Api\UserController::class, 'hours']);
Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);

//appointments
Route::get('/appointments', [\App\Http\Controllers\Api\AppointmentController::class, 'index']);
Route::post('/appointments', [\App\Http\Controllers\Api\AppointmentController::class, 'store']);

    
});







