<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    // Muestra la lista de todos los usuarios, EXCLUYENDO AL ADMINISTRADOR
    public function index()
    {
        $adminEmail = env('ADMIN_EMAIL', 'admin@nubra.com');
        $users = Usuario::where('correo', '!=', $adminEmail)
                        ->orderBy('nombre', 'asc')
                        ->get(); 
        
    
        return view('admin.user.index', compact('users')); 
    }

    public function create()
    {
        return view('admin.user.create');
    }

    // Almacena un nuevo usuario
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'correo' => 'required|email|unique:usuarios,correo',
            'contrasena' => 'required|min:6|confirmed',
            'activo' => 'boolean',
        ]);
        
        Usuario::create([
            'nombre' => $validated['nombre'],
            'apellido_paterno' => $validated['apellido_paterno'],
            'apellido_materno' => $validated['apellido_materno'],
            'correo' => $validated['correo'],
            'contrasena' => Hash::make($validated['contrasena']),
            'activo' => $request->has('activo'),
        ]);
        
        return redirect()->route('admin.users.index')->with('success', 'Usuario creado exitosamente.');
    }

    // Muestra el formulario de edición
    public function edit(Usuario $user)
    {
        if ($user->correo === env('ADMIN_EMAIL', 'admin@nubra.com')) {
            return redirect()->route('admin.users.index')->with('error', 'Acceso denegado: No puedes editar la cuenta de administrador principal.');
        }
        
        // ¡CORREGIDO! Usando 'admin.user.edit'
        return view('admin.user.edit', compact('user'));
    }

    // Actualiza la información del usuario
    public function update(Request $request, Usuario $user)
    {
        if ($user->correo === env('ADMIN_EMAIL', 'admin@nubra.com')) {
            return redirect()->route('admin.users.index')->with('error', 'Acceso denegado: No puedes actualizar la cuenta de administrador principal.');
        }
        
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'correo' => ['required', 'email', Rule::unique('usuarios')->ignore($user->id)], 
            'contrasena' => 'nullable|min:6|confirmed',
            'activo' => 'boolean',
        ]);
        
        $data = [
            'nombre' => $validated['nombre'],
            'apellido_paterno' => $validated['apellido_paterno'],
            'apellido_materno' => $validated['apellido_materno'],
            'correo' => $validated['correo'],
            'activo' => $request->has('activo'),
        ];
        
        if (!empty($validated['contrasena'])) {
            $data['contrasena'] = Hash::make($validated['contrasena']);
        }
        
        $user->update($data);
        
        return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    // Elimina el usuario
    public function destroy(Usuario $user)
    {
        if ($user->correo === env('ADMIN_EMAIL', 'admin@nubra.com')) {
            return redirect()->route('admin.users.index')->with('error', 'Acceso denegado: No puedes eliminar la cuenta de administrador principal.');
        }
        
        try {
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')->with('error', 'Error al eliminar el usuario. Inténtalo de nuevo.');
        }
    }
}