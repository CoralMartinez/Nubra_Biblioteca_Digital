<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'correo',
        'contrasena',
        'fecha_nacimiento',
    ];

    protected $hidden = [
        'contrasena',
    ];

    // Laravel usa 'password' por defecto, pero nuestra columna es 'contrasena'
    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    // Laravel usa 'email' por defecto, pero nuestra columna es 'correo'
    public function getEmailForPasswordReset()
    {
        return $this->correo;
    }

    // Método para obtener el nombre completo
    public function getNombreCompletoAttribute()
    {
        return "{$this->nombre} {$this->apellido_paterno} {$this->apellido_materno}";
    }
}