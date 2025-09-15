<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Doctor\ScheduleController;
use App\Http\Controllers\AppointmentController;
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

Route::post('/schedule', [\App\Http\Controllers\Doctor\ScheduleController::class, 'store']);

});

Route::middleware('auth')->group(function () {
	/*Route::get('/profile', 'UserController@edit');
	Route::post('/profile', 'UserController@update');

	Route::middleware('phone')->group(function () {	
		Route::get('/appointments/create', 'AppointmentController@create');
		Route::post('/appointments', 'AppointmentController@store');
	});*/

	/*Route::get('/appointments', 'AppointmentController@index');	
	Route::get('/appointments/{appointment}', 'AppointmentController@show');

	Route::get('/appointments/{appointment}/cancel', 'AppointmentController@showCancelForm');
	Route::post('/appointments/{appointment}/cancel', 'AppointmentController@postCancel');

	Route::post('/appointments/{appointment}/confirm', 'AppointmentController@postConfirm');*/

    Route::get('/appointments/create', [\App\Http\Controllers\AppointmentController::class, 'create']);
    Route::post('/appointments', [\App\Http\Controllers\AppointmentController::class, 'store']);
	Route::get('/appointments', [\App\Http\Controllers\AppointmentController::class, 'index']);

    Route::get('/specialties/{specialty}/doctors', [\App\Http\Controllers\Api\SpecialtyController::class, 'doctors']);
    Route::get('/schedule/hours', [\App\Http\Controllers\Api\ScheduleController::class, 'hours']);
});


