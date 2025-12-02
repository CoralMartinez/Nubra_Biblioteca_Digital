<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('libros_digitales', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('autor');
            $table->text('descripcion')->nullable();
            
            // Filtros
            $table->string('genero')->nullable(); // Ficción, Ciencia, etc.
            $table->string('idioma')->default('Español');
            $table->string('tipo')->default('libro'); // Libro, Revista, Tesis
            
            // Archivos
            $table->string('ruta_archivo')->nullable(); // Path del PDF
            $table->string('ruta_portada')->nullable(); // Path de la imagen
            
            // Estadísticas
            $table->unsignedBigInteger('vistas')->default(0);
            $table->unsignedBigInteger('descargas')->default(0);
            $table->boolean('destacado')->default(false);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('libros_digitales');
    }
};