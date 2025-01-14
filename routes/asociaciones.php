<?php

use App\Http\Controllers\AsociacionController;

Route::group(['prefix' => 'asociaciones'], function() {
    Route::get('/', [AsociacionController::class, 'index'])->name('dashboard.asociaciones');
    Route::get('/{id}', [AsociacionController::class, 'show'])->name('dashboard.asociaciones.show')->where('id', '[0-9]+');
    Route::get('edit/{id}', [AsociacionController::class, 'getEdit'])->where('id', '[0-9]+');
    Route::put('edit/{id}', [AsociacionController::class, 'update'])->name('dashboard.asociaciones.edit')->where('id', '[0-9]+');
    Route::delete('delete/{id}', [AsociacionController::class, 'destroy'])->name('dashboard.asociaciones.delete')->where('id', '[0-9]+');
    Route::post('publicar/{id}', [AsociacionController::class, 'publicar'])->name('dashboard.asociaciones.publicar')->where('id', '[0-9]+');
    Route::post('ocultar/{id}', [AsociacionController::class, 'ocultar'])->name('dashboard.asociaciones.ocultar')->where('id', '[0-9]+');
});