<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\SessionController;

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
