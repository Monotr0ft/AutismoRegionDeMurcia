<?php

use App\Http\Controllers\EtiquetaController;

Route::group(['prefix' => 'etiquetas'], function() {
    Route::get('/', [EtiquetaController::class, 'index'])->name('dashboard.etiquetas');
    Route::get('/create', [EtiquetaController::class, 'getCreate'])->name('dashboard.etiquetas.create');
    Route::get('/edit/{id}', [EtiquetaController::class, 'getEdit'])->name('dashboard.etiquetas.edit')->where('id', '[0-9]+');
    Route::post('/create', [EtiquetaController::class, 'store'])->name('dashboard.etiquetas.store');
    Route::put('/edit/{id}', [EtiquetaController::class, 'update'])->name('dashboard.etiquetas.update')->where('id', '[0-9]+');
    Route::delete('/delete/{id}', [EtiquetaController::class, 'destroy'])->name('dashboard.etiquetas.delete')->where('id', '[0-9]+');
});