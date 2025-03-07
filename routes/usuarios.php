<?php

use App\Http\Controllers\UserController;

Route::get('/panel', function() {
    $user = Auth::user();
    return app(UserController::class)->show($user);
})->name('panel');

Route::get('/usuarios', [UserController::class, 'index'])->name('dashboard.usuarios');

Route::get('/usuarios/create', [UserController::class, 'getCreate'])->name('dashboard.usuarios.create');

Route::get('/usuarios/edit/{id}', [UserController::class, 'getEdit'])->name('dashboard.usuarios.edit');

Route::post('/usuarios/create', [UserController::class, 'store'])->name('dashboard.usuarios.store');

Route::post('/usuarios/update-permission', [UserController::class, 'updatePermission'])
    ->name('usuarios.updatePermission');

Route::put('/panel/password', [UserController::class, 'update_password'])->name('panel.update.password');

Route::put('/panel/name', [UserController::class, 'update_name'])->name('panel.update.name');

Route::put('/usuarios/edit/{id}', [UserController::class, 'update'])->name('dashboard.usuarios.update');

Route::delete('/usuarios/{user}', [UserController::class, 'destroy'])->name('dashboard.usuarios.destroy');
