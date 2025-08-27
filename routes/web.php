<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Antiguo
//Route::get('/home', 'HomeController@index')->name('home');

// Specialty

//Antiguo
//Route::get('/specialties', 'SpecialtyController@index');
Route::get('/specialties', [\App\Http\Controllers\SpecialtyController::class, 'index']);

//Route::get('/specialties/create', 'SpecialtyController@create');//form registro
Route::get('/specialties/create', [\App\Http\Controllers\SpecialtyController::class, 'create']);


//Route::get('/specialties/{specialty}/edit', 'SpecialtyController@edit');
Route::get('/specialties/{specialty}/edit', [\App\Http\Controllers\SpecialtyController::class, 'edit']);

//Route::get('/specialties', 'SpecialtyController@store');// envio del form
Route::post('/specialties', [\App\Http\Controllers\SpecialtyController::class, 'store']);

Route::put('/specialties/{specialty}', [\App\Http\Controllers\SpecialtyController::class, 'update']);

Route::delete('/specialties/{specialty}', [\App\Http\Controllers\SpecialtyController::class, 'destroy']);


//Doctors

//Route::resource('doctors','DoctorController');
use App\Http\Controllers\DoctorController;
Route::resource('/doctors', DoctorController::class);


//Patients