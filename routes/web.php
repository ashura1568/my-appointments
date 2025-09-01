<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Doctor\ScheduleController;
use App\Http\Middleware\MiMiddlewarePersonalizado;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth','admin'])->group(function () {

//namespace busca en la carpeta que se le indique    
//Route::middleware(['auth','admin'])->namespace('Admin')->group(function () {

//Antiguo
//Route::get('/home', 'HomeController@index')->name('home');

// Specialty

//Antiguo
//Route::get('/specialties', 'SpecialtyController@index');
Route::get('/specialties', [\App\Http\Controllers\Admin\SpecialtyController::class, 'index']);

//Route::get('/specialties/create', 'SpecialtyController@create');//form registro
Route::get('/specialties/create', [\App\Http\Controllers\Admin\SpecialtyController::class, 'create']);


//Route::get('/specialties/{specialty}/edit', 'SpecialtyController@edit');
Route::get('/specialties/{specialty}/edit', [\App\Http\Controllers\Admin\SpecialtyController::class, 'edit']);

//Route::get('/specialties', 'SpecialtyController@store');// envio del form
Route::post('/specialties', [\App\Http\Controllers\Admin\SpecialtyController::class, 'store']);

Route::put('/specialties/{specialty}', [\App\Http\Controllers\Admin\SpecialtyController::class, 'update']);

Route::delete('/specialties/{specialty}', [\App\Http\Controllers\Admin\SpecialtyController::class, 'destroy']);


//Doctors

//Route::resource('doctors','DoctorController');

Route::resource('/doctors', DoctorController::class);


//Patients

Route::resource('/patients', PatientController::class);

});
Route::middleware(['auth','doctor'])->group(function () {

Route::get('/schedule', [\App\Http\Controllers\Doctor\ScheduleController::class, 'edit']);
});
