<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
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

// Navegación
Route::resource('/home', App\Http\Controllers\HomeController::class);

// Controladores
// route::get('/inicio', [InicioController::class, 'inicio']);
// route::get('/repositorio', [InicioController::class, 'repositorio']);

Route::middleware('auth')->group(function () {
    // Cerrar sesión
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Inicio
    Route::get('/inicio', [InicioController::class, 'index'])->name('home');
    
    // Perfil del usuario
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

// ------------------------------------------------------
// 🌿 Ruta temporal para probar la vista del Repositorio de Libros
// (Solo para verificar que repositorio-libros.blade.php funciona correctamente)
// ------------------------------------------------------
Route::get('/repositorio-libros', function () {
    // Datos de ejemplo (solo para pruebas)
    $libros = collect([
        (object)[
            'idLibro' => 1,
            'titulo' => 'Cien años de soledad',
            'autor' => 'Gabriel García Márquez',
            'descripcion' => 'Una obra maestra del realismo mágico latinoamericano.',
            'imagen' => 'https://m.media-amazon.com/images/I/81af+MCATTL._AC_UF1000,1000_QL80_.jpg'
        ],
        (object)[
            'idLibro' => 2,
            'titulo' => 'Rayuela',
            'autor' => 'Julio Cortázar',
            'descripcion' => 'Una novela experimental que desafía las normas literarias.',
            'imagen' => 'https://m.media-amazon.com/images/I/71iZT9X6TFL._AC_UF1000,1000_QL80_.jpg'
        ],
        (object)[
            'idLibro' => 3,
            'titulo' => 'El Principito',
            'autor' => 'Antoine de Saint-Exupéry',
            'descripcion' => 'Un clásico lleno de enseñanzas sobre la vida, el amor y la amistad.',
            'imagen' => 'https://m.media-amazon.com/images/I/61yD3F8xw2L._AC_UF1000,1000_QL80_.jpg'
        ],
    ]);

    // Retornar la vista repositorio-libros.blade.php con los datos simulados
    return view('repositorio-libros', compact('libros'));
});
