<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/home', App\Http\Controllers\HomeController::class);


Route::resource('inicio', App\Http\Controllers\InicioController::class);
Route::resource('sigup', App\Http\Controllers\SignupController::class);
