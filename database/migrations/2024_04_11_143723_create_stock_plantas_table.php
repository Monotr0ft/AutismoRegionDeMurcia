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
        Schema::connection('mysql-arba')->create('stock_plantas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('planta_id');
            $table->unsignedBigInteger('lugar_id');
            $table->unsignedBigInteger('ubicacion_id');
            $table->unsignedBigInteger('contenedor_id');
            $table->date('fecha_planta')->nullable();
            $table->integer('savia')->nullable();
            $table->integer('stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mysql-arba')->dropIfExists('stock_plantas');
    }
};
