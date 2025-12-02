<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\LibroFisico;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Método para el Dashboard (Ruta: admin.dashboard)
    public function index()
    {
        // Estadísticas reales
        $stats = [
            'usuarios_totales' => Usuario::count(),
            'libros_fisicos'   => LibroFisico::count(),
            'intentos_login'   => DB::table('intentos_login')->count(),
            'nuevos_usuarios'  => Usuario::whereMonth('created_at', now()->month)->count()
        ];

        $usuariosRecientes = Usuario::orderBy('created_at', 'desc')->paginate(5);

        return view('admin.dashboard', compact('stats', 'usuariosRecientes'));
    }
    
    // ----------------------------------------------------------------------
    // MÉTODOS AÑADIDOS PARA GESTIÓN DE USUARIOS
    // ----------------------------------------------------------------------

    /**
     * Muestra la lista de usuarios. (Ruta: admin.users.index)
     */
    public function indexUsers()
    {
        // Obtiene todos los usuarios, excluyendo al usuario actual (admin)
        $users = Usuario::where('id', '!=', auth()->id())
                        ->orderBy('created_at', 'desc')
                        ->paginate(15);

        // La vista de listado de usuarios que ya tienes
        return view('admin.user.index', compact('users'));
    }

    /**
     * Muestra el formulario para crear un nuevo usuario. (Ruta: admin.users.create)
     */
    public function createUsers()
    {
        // La vista del formulario de creación que debes tener
        return view('admin.user.create');
    }

    /**
     * Muestra el formulario para editar un usuario específico. (Ruta: admin.users.edit)
     */
    public function editUsers($id)
    {
        $user = Usuario::findOrFail($id);
        
        // La vista del formulario de edición que debes tener
        return view('admin.user.edit', compact('user'));
    }
    
    // ----------------------------------------------------------------------
    // MÉTODOS DE MANEJO DE DATOS (Store, Update, Destroy)
    // ----------------------------------------------------------------------

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

        // Redirige al listado de usuarios (users.index)
        return redirect()->route('admin.users.index')->with('success', 'Usuario creado correctamente.');
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:100',
            // Asegura que el correo sea único, excepto para este usuario
            'email' => 'required|email|unique:usuarios,correo,'.$id.',id', 
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

        // Redirige al listado de usuarios (users.index)
        return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        if (auth()->user()->id == $id) {
            return redirect()->route('admin.users.index')->with('error', 'No puedes eliminar tu propia cuenta.');
        }

        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        // Redirige al listado de usuarios (users.index)
        return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}