<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::resources('/home', App\Http\Controllers\HomeController::class);
Route::resources('/sigup', App\Http\Controllers\SignupController::class);