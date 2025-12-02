<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LibroDigital;

class LibroDigitalSeeder extends Seeder
{
    public function run(): void
    {
        $libros = [
            [
                'titulo' => 'Cien Años de Soledad',
                'autor' => 'Gabriel García Márquez',
                'genero' => 'ficcion',
                'idioma' => 'español',
                'tipo' => 'libro',
                'vistas' => 1234,
                'descargas' => 567,
                'destacado' => true,
                'descripcion' => 'La obra maestra del realismo mágico.'
            ],
            [
                'titulo' => 'El Principito',
                'autor' => 'Antoine de Saint-Exupéry',
                'genero' => 'infantil',
                'idioma' => 'español',
                'tipo' => 'libro',
                'vistas' => 892,
                'descargas' => 445,
                'destacado' => true,
                'descripcion' => 'Un cuento poético sobre la soledad y la amistad.'
            ],
            [
                'titulo' => '1984',
                'autor' => 'George Orwell',
                'genero' => 'ficcion',
                'idioma' => 'ingles',
                'tipo' => 'libro',
                'vistas' => 756,
                'descargas' => 389,
                'destacado' => false,
                'descripcion' => 'Novela política de distopía de ficción.'
            ],
            [
                'titulo' => 'Don Quijote',
                'autor' => 'Miguel de Cervantes',
                'genero' => 'clasico',
                'idioma' => 'español',
                'tipo' => 'libro',
                'vistas' => 2145,
                'descargas' => 998,
                'destacado' => false,
                'descripcion' => 'El ingenioso hidalgo Don Quijote de la Mancha.'
            ],
             [
                'titulo' => 'Breve Historia del Tiempo',
                'autor' => 'Stephen Hawking',
                'genero' => 'ciencia',
                'idioma' => 'ingles',
                'tipo' => 'libro',
                'vistas' => 500,
                'descargas' => 120,
                'destacado' => false,
                'descripcion' => 'Un libro de divulgación científica.'
            ],
        ];

        foreach ($libros as $libro) {
            LibroDigital::create($libro);
        }
    }
}