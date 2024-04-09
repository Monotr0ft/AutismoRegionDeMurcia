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
        Schema::connection('mysql-arba')->table('socios', function (Blueprint $table) {
            $table->foreign('direccion')->references('id')->on('direcciones_arba')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users_arba')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mysql-arba')->table('socios', function (Blueprint $table) {
            $table->dropForeign('socios_user_id_foreign');
            $table->dropForeign('socios_direccion_foreign');
        });
    }
};
