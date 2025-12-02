<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Usuario;

class AuthController extends Controller
{
    // 1. Mostrar formulario de login USUARIO (Normal)
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // 2. NUEVO: Mostrar formulario de login ADMIN (Centrado)
    public function showAdminLoginForm()
    {
        return view('auth.login-admin');
    }

    // 3. Procesar login (Funciona para ambos: Admin y Usuario)
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'El correo es obligatorio',
            'email.email' => 'Ingresa un correo válido',
            'password.required' => 'La contraseña es obligatoria',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres',
        ]);

        // Buscar usuario
        $usuario = Usuario::where('correo', $request->email)->first();

        // Registrar intento de login
        DB::table('intentos_login')->insert([
            'correo' => $request->email,
            'exitoso' => 0,
            'fecha_intento' => now(),
            'ip_address' => $request->ip(),
        ]);

        // Verificar si existe el usuario
        if (!$usuario) {
            return back()->withErrors([
                'login_error' => 'Las credenciales no coinciden con nuestros registros.'
            ])->withInput($request->only('email'));
        }

        // Verificar si está activo
        if (!$usuario->activo) {
            return back()->withErrors([
                'login_error' => 'Tu cuenta está desactivada. Contacta al administrador.'
            ])->withInput($request->only('email'));
        }

        // Verificar contraseña
        if (!Hash::check($request->password, $usuario->contrasena)) {
            return back()->withErrors([
                'login_error' => 'Las credenciales no coinciden con nuestros registros.'
            ])->withInput($request->only('email'));
        }

        // --- LOGIN EXITOSO ---
        Auth::login($usuario);

        // Actualizar último acceso
        $usuario->update(['ultimo_acceso' => now()]);

        // Actualizar intento como exitoso
        DB::table('intentos_login')
            ->where('correo', $request->email)
            ->orderBy('id', 'desc')
            ->limit(1)
            ->update(['exitoso' => 1]);

        // --- LÓGICA DE REDIRECCIÓN (AQUÍ ESTÁ EL CAMBIO) ---
        
        // Si el rol es 'admin', lo enviamos a su Dashboard
        if ($usuario->role === 'admin') {
            return redirect()->intended('/admin/dashboard');
        }

        // Si es usuario normal, va al inicio de la biblioteca
        return redirect()->intended('/inicio');
    }

    // Mostrar formulario de registro
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Procesar registro
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido_paterno' => 'required|string|max:100',
            'apellido_materno' => 'required|string|max:100',
            'email' => 'required|email|max:255|unique:usuarios,correo',
            'password' => 'required|min:6|confirmed',
            'fecha_nacimiento' => 'required|date|before:today',
        ], [
            'nombre.required' => 'El nombre es obligatorio',
            'apellido_paterno.required' => 'El apellido paterno es obligatorio',
            'apellido_materno.required' => 'El apellido materno es obligatorio',
            'email.required' => 'El correo es obligatorio',
            'email.email' => 'Ingresa un correo válido',
            'email.unique' => 'Este correo ya está registrado',
            'password.required' => 'La contraseña es obligatoria',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria',
            'fecha_nacimiento.before' => 'La fecha de nacimiento debe ser anterior a hoy',
        ]);

        // Crear usuario (Por defecto rol 'usuario' en la BD)
        Usuario::create([
            'nombre' => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'correo' => $request->email,
            'contrasena' => Hash::make($request->password),
            'fecha_nacimiento' => $request->fecha_nacimiento,
            // 'rol' => 'usuario' // Esto lo pone la base de datos por defecto
        ]);

        // Redirigir al login con mensaje de éxito
        return redirect('/login')->with('success', 'Usuario registrado correctamente. Por favor inicia sesión.');
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login')->with('success', 'Sesión cerrada correctamente');
    }
}