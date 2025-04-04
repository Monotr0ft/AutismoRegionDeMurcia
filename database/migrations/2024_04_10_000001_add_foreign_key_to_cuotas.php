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
        Schema::connection('mysql-arba')->table('cuotas', function (Blueprint $table) {
            $table->foreign('socio_id')->references('id')->on('socios')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mysql-arba')->table('cuotas', function (Blueprint $table) {
            $table->dropForeign('cuotas_socio_id_foreign');
        });
    }
};
