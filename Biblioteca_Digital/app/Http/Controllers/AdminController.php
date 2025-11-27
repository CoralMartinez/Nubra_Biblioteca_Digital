<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\LibroFisico;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        // Estadísticas reales
        $stats = [
            'usuarios_totales' => Usuario::count(),
            'libros_fisicos'   => LibroFisico::count(),
            'intentos_login'   => DB::table('intentos_login')->count(),
            'nuevos_usuarios'  => Usuario::whereMonth('created_at', now()->month)->count()
        ];

        // CAMBIO AQUÍ: Usamos paginate(5) en lugar de take(5)->get()
        $usuariosRecientes = Usuario::orderBy('created_at', 'desc')->paginate(5);

        return view('admin.dashboard', compact('stats', 'usuariosRecientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido_paterno' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios,correo',
            'password' => 'required|min:6',
            'rol' => 'required|in:admin,usuario',
            'fecha_nacimiento' => 'required|date',
        ]);

        Usuario::create([
            'nombre' => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno ?? '',
            'correo' => $request->email,
            'contrasena' => Hash::make($request->password),
            'rol' => $request->rol,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'activo' => 1
        ]);

        return redirect()->back()->with('success', 'Usuario creado correctamente.');
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios,correo,'.$id,
            'rol' => 'required|in:admin,usuario',
        ]);

        $data = [
            'nombre' => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'correo' => $request->email,
            'rol' => $request->rol,
            'fecha_nacimiento' => $request->fecha_nacimiento,
        ];

        if ($request->filled('password')) {
            $data['contrasena'] = Hash::make($request->password);
        }

        $usuario->update($data);

        return redirect()->back()->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        if (auth()->user()->id == $id) {
            return redirect()->back()->with('error', 'No puedes eliminar tu propia cuenta.');
        }

        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->back()->with('success', 'Usuario eliminado correctamente.');
    }
}