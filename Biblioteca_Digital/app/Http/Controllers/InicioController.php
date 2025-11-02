<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InicioController extends Controller
{
    //public function inicio()
    //{
    //    return view('inicio');
    //}

    public function repositorio()
    {
        return view('repositorio');
    }

    public function index()
    {
        // Aquí puedes agregar lógica para obtener estadísticas reales
        $stats = [
            'libros_digitales' => 1234, // Reemplazar con consulta real
            'usuarios_activos' => 573,   // Reemplazar con consulta real
            'lecturas_completadas' => 2847, // Reemplazar con consulta real
            'crecimiento' => 12 // Porcentaje de crecimiento
        ];

        return view('inicio', compact('stats'));
    }
}
