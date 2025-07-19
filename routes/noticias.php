<?php

use App\Http\Controllers\NoticiaController;

Route::group(['prefix' => 'noticias'], function() {
    Route::get('/', [NoticiaController::class, 'index'])->name('dashboard.noticias');
    Route::get('/create', [NoticiaController::class, 'getCreate'])->name('dashboard.noticias.create');
    Route::get('/edit/{id}', [NoticiaController::class, 'getEdit'])->name('dashboard.noticias.edit')->where('id', '[0-9]+');
    Route::post('/create', [NoticiaController::class, 'store'])->name('dashboard.noticias.store');
    Route::put('/edit/{id}', [NoticiaController::class, 'update'])->name('dashboard.noticias.update')->where('id', '[0-9]+');
    Route::delete('/delete/{id}', [NoticiaController::class, 'destroy'])->name('dashboard.noticias.delete')->where('id', '[0-9]+');
    Route::post('/publicar/{id}', [NoticiaController::class, 'publicar'])->name('dashboard.noticias.publicar')->where('id', '[0-9]+');
    Route::post('/ocultar/{id}', [NoticiaController::class, 'ocultar'])->name('dashboard.noticias.ocultar')->where('id', '[0-9]+');
});