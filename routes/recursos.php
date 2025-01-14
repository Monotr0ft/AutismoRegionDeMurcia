<?php

use App\Http\Controllers\RecursoController;

Route::group(['prefix' => 'recursos'], function() {
    Route::get('/', [RecursoController::class, 'index'])->name('dashboard.recursos');
    Route::get('/create', [RecursoController::class, 'getCreate'])->name('dashboard.recursos.create');
    Route::get('/edit/{id}', [RecursoController::class, 'getEdit'])->name('dashboard.recursos.edit')->where('id', '[0-9]+');
    Route::post('/create', [RecursoController::class, 'store'])->name('dashboard.recursos.store');
    Route::put('/edit/{id}', [RecursoController::class, 'update'])->name('dashboard.recursos.update')->where('id', '[0-9]+');
    Route::delete('/delete/{id}', [RecursoController::class, 'destroy'])->name('dashboard.recursos.delete')->where('id', '[0-9]+');
});