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
        Schema::create('apartados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->boolean('administrador')->default(false);
            $table->boolean('asociaciones')->default(false);
            $table->boolean('noticias')->default(false);
            $table->boolean('paginas')->default(false);
            $table->boolean('recursos')->default(false);
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartados');
    }
};
