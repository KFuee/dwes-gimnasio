<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\AppointmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Rutas generales
Route::get('/', [HomeController::class, 'index'])
  ->name('home');

// Rutas de autenticación
Auth::routes(['verify' => true]);

// Rutas de usuarios
Route::resource('users', UserController::class);

// Rutas de actividades
Route::resource('activities', ActivityController::class);

// Rutas de sesiones
Route::resource('sessions', SessionController::class);

// Rutas de reservas
Route::resource('appointments', AppointmentController::class);
Route::name('appointments.')->prefix('appointments')->group(function () {
  Route::get('/activities', [AppointmentController::class, 'activities'])
    ->name('activities');
  Route::get('/months/{activity}', [AppointmentController::class, 'months'])
    ->name('months');
  Route::get('/sessions/{activity}/{month}', [AppointmentController::class, 'sessions'])
    ->name('sessions');
});
