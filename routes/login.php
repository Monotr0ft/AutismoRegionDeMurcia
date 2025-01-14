<?php

use App\Http\Controllers\UserController;

Route::get('/login', [UserController::class, 'getLogin']);
Route::post('/login', [UserController::class, 'postLogin'])->name('login');
Route::post('/logout', [UserController::class, 'postLogout'])->name('logout');