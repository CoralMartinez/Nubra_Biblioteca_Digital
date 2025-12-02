<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LibroDigital;

class RepositorioController extends Controller
{
    public function index(Request $request)
    {
        // 1. Iniciamos la consulta
        $query = LibroDigital::query();

        // 2. Aplicar Búsqueda por texto (Título o Autor)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('titulo', 'LIKE', "%{$search}%")
                  ->orWhere('autor', 'LIKE', "%{$search}%");
            });
        }

        // 3. Aplicar Filtros Específicos
        if ($request->filled('genero')) {
            $query->where('genero', $request->genero);
        }

        if ($request->filled('idioma')) {
            $query->where('idioma', $request->idioma);
        }

        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }

        // 4. Ordenamiento
        switch ($request->get('orden')) {
            case 'populares':
                $query->orderBy('vistas', 'desc');
                break;
            case 'descargados':
                $query->orderBy('descargas', 'desc');
                break;
            case 'az':
                $query->orderBy('titulo', 'asc');
                break;
            case 'za':
                $query->orderBy('titulo', 'desc');
                break;
            default: // 'recientes'
                $query->orderBy('created_at', 'desc');
                break;
        }

        // 5. Paginación
        $libros = $query->paginate(9)->withQueryString(); // Mantiene los filtros en la URL al cambiar de página

        // Estadísticas generales para el header
        $stats = [
            'total_libros' => LibroDigital::count(),
            'descargas' => LibroDigital::sum('descargas'),
            'vistas' => LibroDigital::sum('vistas'),
        ];

        return view('repositorio', compact('libros', 'stats'));
    }

    // Método para simular descarga (incrementa contador)
    public function download($id)
    {
        $libro = LibroDigital::findOrFail($id);
        $libro->increment('descargas');
        
        // Aquí iría la lógica real: return Storage::download($libro->ruta_archivo);
        return back()->with('success', "Descarga iniciada para: {$libro->titulo}");
    }
}