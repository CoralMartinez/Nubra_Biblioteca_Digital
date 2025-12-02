<?php

namespace App\Http\Controllers;

use App\Models\LibroFisico;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $libros = LibroFisico::orderBy('created_at', 'desc')->paginate(10);
        return view('inventario.index', compact('libros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventario.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'año' => 'required|integer|min:1000|max:' . (date('Y') + 1),
            'clasificacion' => 'required|string|max:50',
            'ubicacion' => 'required|string|max:100',
        ], [
            'titulo.required' => 'El título es obligatorio',
            'autor.required' => 'El autor es obligatorio',
            'año.required' => 'El año es obligatorio',
            'año.integer' => 'El año debe ser un número',
            'año.min' => 'El año no es válido',
            'año.max' => 'El año no puede ser mayor al actual',
            'clasificacion.required' => 'La clasificación es obligatoria',
            'ubicacion.required' => 'La ubicación es obligatoria',
        ]);

        LibroFisico::create($validated);

        return redirect()->route('inventario.index')
            ->with('success', 'Libro agregado exitosamente al inventario');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $libro = LibroFisico::findOrFail($id);
        return view('inventario.show', compact('libro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $libro = LibroFisico::findOrFail($id);
        return view('inventario.edit', compact('libro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'año' => 'required|integer|min:1000|max:' . (date('Y') + 1),
            'clasificacion' => 'required|string|max:50',
            'ubicacion' => 'required|string|max:100',
        ], [
            'titulo.required' => 'El título es obligatorio',
            'autor.required' => 'El autor es obligatorio',
            'año.required' => 'El año es obligatorio',
            'año.integer' => 'El año debe ser un número',
            'clasificacion.required' => 'La clasificación es obligatoria',
            'ubicacion.required' => 'La ubicación es obligatoria',
        ]);

        $libro = LibroFisico::findOrFail($id);
        $libro->update($validated);

        return redirect()->route('inventario.index')
            ->with('success', 'Libro actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $libro = LibroFisico::findOrFail($id);
        $libro->delete();

        return redirect()->route('inventario.index')
            ->with('success', 'Libro eliminado del inventario');
    }
}