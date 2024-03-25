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
        Schema::connection('mysql-arba')->create('socios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido1');
            $table->string('apellido2');
            $table->string('dni');
            $table->integer('telefono');
            $table->unsignedBigInterger('direccion');
            $table->string('email');
            $table->boolean('activo')->default(true);
            $table->date('fecha_alta');
            $table->date('fecha_baja')->nullable();
            $table->boolean('junta_directiva')->default(false);
            $table->string('posicion')->nullable()->unique();
            $table->boolean('acceso_web')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mysql-arba')->dropIfExists('socios');
    }
};
