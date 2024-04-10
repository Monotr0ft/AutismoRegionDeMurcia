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
        Schema::connection('mysql-arba')->create('cuotas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('socio_id');
            $table->boolean('pagada')->default(false);
            $table->integer('importe');
            $table->date('fecha_pago')->nullable();
            $table->integer('ejercicio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mysql-arba')->dropIfExists('cuotas');
    }
};
