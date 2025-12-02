<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RepositorioController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PerfilController;
use App\Http\Middleware\AdminMiddleware;

// ZONA PÚBLICA 
// Rutas accesibles para usuarios no logueados

Route::middleware('guest')->group(function () {
    
    //Redirección raíz
    Route::get('/', function () { return view('auth.login'); });

    //Login Usuario General
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    //Registro Usuario
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    //Login Administrador
    Route::get('/admin/login', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
});

// ZONA PROTEGIDA (AUTH)
// Rutas accesibles SOLO para usuarios logueados (Cualquier rol)

Route::middleware('auth')->group(function () {

    // --- Rutas Comunes ---
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/inicio', [InicioController::class, 'index'])->name('home');
    
    // Perfil de Usuario
    Route::get('/perfil', [PerfilController::class, 'show'])->name('perfil');
    Route::put('/perfil', [PerfilController::class, 'update'])->name('perfil.update');
    Route::get('/perfil/editar', [PerfilController::class, 'edit'])->name('perfil.edit');

    // --- Módulo Repositorio ---
    Route::prefix('repositorio')->name('repositorio.')->group(function () {
        Route::get('/', [RepositorioController::class, 'index'])->name('index');
        Route::get('/create', [RepositorioController::class, 'create'])->name('create');
        Route::post('/', [RepositorioController::class, 'store'])->name('store');
        Route::get('/{id}', [RepositorioController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [RepositorioController::class, 'edit'])->name('edit');
        Route::put('/{id}', [RepositorioController::class, 'update'])->name('update');
        Route::delete('/{id}', [RepositorioController::class, 'destroy'])->name('destroy');
    });

    // --- Módulo Inventario ---
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

// ZONA ADMINISTRADOR (Middleware 'AdminMiddleware')
// Solo entran usuarios con rol 'admin'
Route::middleware(AdminMiddleware::class)->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard del Administrador
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    // --- GESTIÓN DE USUARIOS ---
    Route::post('/users', [AdminController::class, 'store'])->name('users.store');
    Route::put('/users/{id}', [AdminController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('users.destroy');
});