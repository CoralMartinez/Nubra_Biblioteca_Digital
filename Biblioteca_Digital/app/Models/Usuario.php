<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'correo',
        'contrasena',
        'fecha_nacimiento',
        'activo',
        'ultimo_acceso',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'contrasena',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'fecha_nacimiento' => 'date',
        'ultimo_acceso' => 'datetime',
        'activo' => 'boolean',
    ];

    /**
     * Get the password for authentication.
     * Laravel espera un campo 'password', pero nosotros usamos 'contrasena'
     */
    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    /**
     * Get the name of the unique identifier for the user.
     * Laravel espera 'email', pero nosotros usamos 'correo'
     */
    public function getEmailForPasswordReset()
    {
        return $this->correo;
    }

    /**
     * Accessor para obtener apellidos completos
     */
    public function getApellidosAttribute()
    {
        return trim($this->apellido_paterno . ' ' . $this->apellido_materno);
    }

    /**
     * Accessor para obtener nombre completo
     */
    public function getNombreCompletoAttribute()
    {
        return trim($this->nombre . ' ' . $this->apellido_paterno . ' ' . $this->apellido_materno);
    }

    /**
     * Accessor para email (compatibilidad con Laravel)
     */
    public function getEmailAttribute()
    {
        return $this->correo;
    }
}