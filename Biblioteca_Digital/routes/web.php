<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/home', App\Http\Controllers\HomeController::class);


route::get('/inicio', [InicioController::class, 'inicio']);

route::get('/repositorio', [InicioController::class, 'repositorio']);