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
        Schema::connection('mysql-arba')->table('stock_plantas', function (Blueprint $table) {
            $table->foreign('planta_id')->references('id')->on('plantas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('contenedor_id')->references('id')->on('contenedores')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('lugar_id')->references('id')->on('lugares')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('ubicacion_id')->references('id')->on('ubicaciones')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mysql-arba')->table('stock_plantas', function (Blueprint $table) {
            $table->dropForeign('stock_plantas_ubicacion_id_foreign');
            $table->dropForeign('stock_plantas_lugar_id_foreign');
            $table->dropForeign('stock_plantas_contenedor_id_foreign');
            $table->dropForeign('stock_plantas_planta_id_foreign');
        });
    }
};
