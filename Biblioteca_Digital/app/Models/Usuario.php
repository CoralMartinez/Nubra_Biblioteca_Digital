<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;
    public $timestamps = false; // 👈 Desactiva created_at y updated_at

    public $timestamps = false; // 👈 Desactiva created_at y updated_at

    protected $table = 'usuarios';

    /**
     * Atributos asignables de forma masiva
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
     * Atributos que deben de permanecer ocultos para la serialización
     */
    protected $hidden = [
        'contrasena',
        'remember_token',
    ];

    /**
     * Atributos que deben de convertirse a otros tipos de datos 
     */
    protected $casts = [
        'fecha_nacimiento' => 'date',
        'ultimo_acceso' => 'datetime',
        'activo' => 'boolean',
    ];

    /**
     * Se obtiene la contraseña para su autenticación
     * 
     * Laravel espera un campo 'password', pero nosotros usamos 'contrasena'
     */
    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    /**
     * Obtiene el nombre del identificador único del usuario.
     * Laravel espera 'email', pero nosotros usamos 'correo'
     */
    public function getEmailForPasswordReset()
    {
        return $this->correo;
    }

    /**
     * Accessor para obtener apellidos completos. 
     * Obtención del apellido paterno & materno del usuario (personalizada & 
     * concatenación de ambos campos del modelo de usuario)
     */
    public function getApellidosAttribute()
    {
        return trim($this->apellido_paterno . ' ' . $this->apellido_materno);
    }

    /**
     * Accessor para obtener nombre completo & concatenación de nombre y apellidos...
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
