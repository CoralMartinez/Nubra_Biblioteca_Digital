<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PerfilController extends Controller
{
    /**
     * Muestra la información actual del perfil y el formulario de edición.
     * Esta función responde a la ruta GET /perfil (nombre: perfil.edit).
     */
    public function edit()
    {
        // Obtiene el modelo del usuario autenticado
        $usuario = Auth::user();

        // Carga la vista de edición/formulario
        return view('perfil.edit', compact('usuario'));
    }

    /**
     * Procesa la solicitud de actualización del perfil.
     * Esta función responde a la ruta PUT/PATCH /perfil (nombre: perfil.update).
     */
    public function update(Request $request)
    {
        $usuario = Auth::user();

        // 1. Reglas de Validación
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'nullable|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            
            // Valida el correo: requerido, email, y único en la tabla 'usuarios' e ignora al usuario actual.
            'correo' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('usuarios', 'correo')->ignore($usuario->id),
            ],

            // Contraseña: opcional, pero si se envía, debe ser de 8 min. y coincidir con la confirmación.
            'contrasena' => 'nullable|string|min:8|confirmed',
        ]);

        // 2. Preparar los Datos para Actualizar
        $datos = $request->only([
            'nombre',
            'apellido_paterno',
            'apellido_materno',
            'correo',
        ]);
        
        // 3. Manejar la Contraseña (solo si se ha enviado una nueva)
        if ($request->filled('contrasena')) {
            $datos['contrasena'] = Hash::make($request->input('contrasena'));
        }

        // 4. Guardar los Cambios
        $usuario->update($datos);

        // 5. Redireccionar con un mensaje de éxito
        return redirect()->route('perfil.edit')->with('success', '¡Perfil actualizado exitosamente!');
    }
}