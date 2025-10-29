<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LibroFisico extends Model
{
    protected $table = 'libros_fisicos';

    protected $fillable = [
        'titulo',
        'autor',
        'año',
        'clasificacion',
        'ubicacion',
    ];

    protected $casts = [
        'año' => 'integer',
    ];
}