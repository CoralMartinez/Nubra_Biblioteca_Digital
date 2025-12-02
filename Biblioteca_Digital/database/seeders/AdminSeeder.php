<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Usuario::create([
            'nombre' => 'Super',
            'apellido_paterno' => 'Admin',
            'apellido_materno' => 'Sistema',
            'correo' => 'admin@nubra.com', // Este será tu usuario
            'contrasena' => Hash::make('admin123'), // Esta será tu contraseña
            'fecha_nacimiento' => '1990-01-01',
            'rol' => 'admin', // IMPORTANTE: Es admin
            'activo' => 1
        ]);
    }
}