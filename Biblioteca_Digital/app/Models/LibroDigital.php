<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibroDigital extends Model
{
    use HasFactory;

    protected $table = 'libros_digitales';

    protected $fillable = [
        'titulo',
        'autor',
        'descripcion',
        'genero',
        'idioma',
        'tipo',
        'ruta_archivo',
        'ruta_portada',
        'vistas',
        'descargas',
        'destacado'
    ];
}