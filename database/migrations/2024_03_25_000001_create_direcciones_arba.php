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
        Schema::connection('mysql-arba')->create('direcciones_arba', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo_via',['Avda','Calle','Travesia','Carretera']);
            $table->string('nombre_via');
            $table->integer('numero');
            $table->string('ampliacion')->nullable();
            $table->integer('codigo_postal');
            $table->string('municipio');
            $table->string('localidad');
            $table->string('provincia')->default('Región de Murcia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mysql-arba')->dropIfExists('direcciones_arba');
    }
};
