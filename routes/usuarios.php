<?php

use App\Http\Controllers\UserController;

Route::get('/panel', function() {
    $user = Auth::user();
    return app(UserController::class)->show($user);
})->name('panel');

Route::put('/panel/password', [UserController::class, 'update_password'])->name('panel.update.password');

Route::put('/panel/name', [UserController::class, 'update_name'])->name('panel.update.name');

Route::put('/panel/email', [UserController::class, 'update_email'])->name('panel.update.email');

Route::get('/usuarios', [UserController::class, 'index'])->name('dashboard.usuarios');

Route::get('/usuarios/create', [UserController::class, 'getCreate'])->name('dashboard.usuarios.create');

Route::post('/usuarios/create', [UserController::class, 'store'])->name('dashboard.usuarios.store');

Route::post('/usuarios/update-permission', [UserController::class, 'updatePermission'])
    ->name('usuarios.updatePermission');
