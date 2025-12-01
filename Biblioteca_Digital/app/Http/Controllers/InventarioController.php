<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// NOTA: Ya no importamos App\Models\LibroFisico porque FastAPI maneja los datos.

class InventarioController extends Controller
{
    /**
     * Muestra la lista principal.
     * Los datos se cargan vía JavaScript (fetch) desde FastAPI.
     */
    public function index()
    {
        return view('inventario.index');
    }

    /**
     * Muestra el formulario de creación.
     */
    public function create()
    {
        return view('inventario.create');
    }

    /**
     * Muestra el formulario de edición.
     * CORRECCIÓN: Ya no buscamos en la BD con Eloquent.
     * Solo pasamos el ID a la vista para que JS consulte a FastAPI.
     */
    public function edit(string $id)
    {
        // Creamos un objeto simple solo con el ID para que la vista no falle
        // al intentar leer {{ $libro->id }}
        $libro = (object) ['id' => $id];
        
        return view('inventario.edit', compact('libro'));
    }

    // --- MÉTODOS OBSOLETOS (Deshabilitados) ---
    // Como ahora tu Frontend (Blade + JS) se comunica directamente con Python (FastAPI),
    // estos métodos de Laravel ya no se utilizan. Los dejo comentados o vacíos
    // para evitar errores si alguna ruta antigua intenta llamarlos.

    public function store(Request $request)
    {
        // La lógica se movió al JS de create.blade.php
        return redirect()->route('inventario.index'); 
    }

    public function update(Request $request, string $id)
    {
        // La lógica se movió al JS de edit.blade.php
        return redirect()->route('inventario.index');
    }

    public function destroy(string $id)
    {
        // La lógica se movió al JS de index.blade.php
        return redirect()->route('inventario.index');
    }
}