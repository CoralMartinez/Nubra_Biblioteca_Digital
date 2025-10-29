<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('libros_fisicos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 255);
            $table->string('autor', 255);
            $table->integer('año');
            $table->string('clasificacion', 50);
            $table->string('ubicacion', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libros_fisicos');
    }
};