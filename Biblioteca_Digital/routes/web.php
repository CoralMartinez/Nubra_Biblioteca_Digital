<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\AuthController;

// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Ruta protegida (ejemplo)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

//Navegación
Route::resource('/home', App\Http\Controllers\HomeController::class);

route::get('/inicio', [InicioController::class, 'inicio']);

route::get('/repositorio', [InicioController::class, 'repositorio']);
