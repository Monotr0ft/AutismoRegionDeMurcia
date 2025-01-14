<?php

use App\Http\Controllers\AsociacionNuevaController;

Route::group(['prefix' => 'asociacionesnuevas'], function() {
    Route::get('/', [AsociacionNuevaController::class, 'index'])->name('dashboard.asociacionesnuevas');
    Route::get('/{id}', [AsociacionNuevaController::class, 'show'])->name('dashboard.asociacionesnuevas.show')->where('id', '[0-9]+');
    Route::get('edit/{id}', [AsociacionNuevaController::class, 'getEdit'])->where('id', '[0-9]+');
    Route::put('edit/{id}', [AsociacionNuevaController::class, 'update'])->name('dashboard.asociacionesnuevas.edit')->where('id', '[0-9]+');
    Route::delete('delete/{id}', [AsociacionNuevaController::class, 'destroy'])->name('dashboard.asociacionesnuevas.delete')->where('id', '[0-9]+');
    Route::post('publicar/{id}', [AsociacionNuevaController::class, 'publicar'])->name('dashboard.asociacionesnuevas.publicar')->where('id', '[0-9]+');
    Route::post('ocultar/{id}', [AsociacionNuevaController::class, 'ocultar'])->name('dashboard.asociacionesnuevas.ocultar')->where('id', '[0-9]+');
});