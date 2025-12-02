<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RepositorioController extends Controller
{
    public function index()
    {
        // Simplemente retorna la vista única
        return view('repositorio');
    }
}