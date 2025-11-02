<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RepositorioController;
use App\Http\Controllers\InventarioController;


Route::get('/', function () {
    return view('auth.login');
});

// Rutas de autenticación (guest - solo para usuarios no autenticados)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});
// Ruta protegida (ejemplo)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

//Navegación
Route::resource('/home', App\Http\Controllers\HomeController::class);

//route::get('/inicio', [InicioController::class, 'inicio']);

//route::get('/repositorio', [InicioController::class, 'repositorio']);


Route::middleware('auth')->group(function () {
    // Cerrar sesión
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Inicio
    Route::get('/inicio', [InicioController::class, 'index'])->name('home');
    
    // Perfil
    Route::get('/perfil', [PerfilController::class, 'show'])->name('perfil');
    Route::put('/perfil', [PerfilController::class, 'update'])->name('perfil.update');
    
    // Repositorio
    Route::prefix('repositorio')->name('repositorio.')->group(function () {
        Route::get('/', [RepositorioController::class, 'index'])->name('index');
        Route::get('/create', [RepositorioController::class, 'create'])->name('create');
        Route::post('/', [RepositorioController::class, 'store'])->name('store');
        Route::get('/{id}', [RepositorioController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [RepositorioController::class, 'edit'])->name('edit');
        Route::put('/{id}', [RepositorioController::class, 'update'])->name('update');
        Route::delete('/{id}', [RepositorioController::class, 'destroy'])->name('destroy');
    });
    
    // Inventario
    Route::prefix('inventario')->name('inventario.')->group(function () {
        Route::get('/', [InventarioController::class, 'index'])->name('index');
        Route::get('/create', [InventarioController::class, 'create'])->name('create');
        Route::post('/', [InventarioController::class, 'store'])->name('store');
        Route::get('/{id}', [InventarioController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [InventarioController::class, 'edit'])->name('edit');
        Route::put('/{id}', [InventarioController::class, 'update'])->name('update');
        Route::delete('/{id}', [InventarioController::class, 'destroy'])->name('destroy');
    });
});
