<?php

use App\Http\Controllers\PaginaController;

Route::group(['prefix' => 'paginas'], function() {
    Route::get('/', [PaginaController::class, 'index'])->name('dashboard.paginas');
    Route::get('/{id}', [PaginaController::class, 'show'])->name('dashboard.paginas.show')->where('id', '[0-9]+');
    Route::get('/edit/{id}', [PaginaController::class, 'getEdit'])->where('id', '[0-9]+');
    Route::put('/edit/{id}', [PaginaController::class, 'edit'])->name('dashboard.paginas.edit')->where('id', '[0-9]+');
    Route::delete('/delete/{id}', [PaginaController::class, 'delete'])->name('dashboard.paginas.delete')->where('id', '[0-9]+');
});