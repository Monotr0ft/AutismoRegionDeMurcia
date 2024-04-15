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
        Schema::create('asociaciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('logo')->nullable();
            $table->enum('tipo', ['Asociación', 'Fundación']);
            $table->string('direccion')->nullable();
            $table->integer('telefono')->nullable();
            $table->string('email');
            $table->string('web');
            $table->text('redes_sociales')->nullable();
            $table->text('descripcion');
            $table->boolean('es_regional');
            $table->boolean('publicar')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asociaciones');
    }
};
