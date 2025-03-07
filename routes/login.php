<?php

use App\Http\Controllers\UserController;

Route::get('/login', [UserController::class, 'getLogin'])->name('login');
Route::post('/login', [UserController::class, 'postLogin'])->name('login');
Route::post('/logout', [UserController::class, 'postLogout'])->name('logout');
Route::get('/login/{token}', [UserController::class, 'getNotYourself'])->name('notyourself');
Route::put('/login/password', [UserController::class, 'reupdate_password'])->name('notyourself.update');