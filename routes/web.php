<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsociacionController;
use App\Http\Controllers\AsociacionNuevaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecursoController;
use App\Http\Controllers\PaginaController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\CookieController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/accept-cookies', [CookieController::class, 'acceptCookies'])->name('accept.cookies');

Route::group(['prefix' => 'asociaciones'], function() {
    Route::get('/', [AsociacionController::class, 'getAsociaciones'])->name('asociaciones');
    Route::get('/formulario', [AsociacionController::class, 'getCreate'])->name('asociaciones.create');
    Route::post('/formulario', [AsociacionNuevaController::class, 'store'])->name('asociaciones.store');
});

Route::get('/noticias', [NoticiaController::class, 'getNoticias'])->name('noticias');

Route::get('/queesarm', [PaginaController::class, 'arm'])->name('queesarm');

Route::get('/autismo', [PaginaController::class, 'autismo'])->name('autismo');

Route::get('/recursos', [RecursoController::class, 'getRecursos'])->name('recursos');

include __DIR__.'/newsletter.php';
include __DIR__.'/login.php';

Route::group(['prefix' => 'dashboard', 'middleware' => 'user'], function() {
    Route::get('/', function() { return view('autismo.dashboard.home'); } )->name('dashboard');
    include __DIR__.'/usuarios.php';
    Route::group(['middleware' => 'can:gestionar_asociaciones'], function() {
        include __DIR__.'/asociaciones.php';
        include __DIR__.'/asociacionesnuevas.php';
    });
    Route::group(['middleware' => 'can:gestionar_noticias'], function() {
        include __DIR__.'/noticias.php';
    });
    Route::group(['middleware' => 'can:gestionar_recursos'], function() {
        include __DIR__.'/recursos.php';
        include __DIR__.'/etiquetas.php';
    });
    Route::group(['middleware' => 'can:gestionar_paginas'], function() {
        include __DIR__.'/paginas.php';
        include __DIR__.'/imageupload.php';
    });
});

/**
 * Include the routes for the ARBA project
 * Do it when I finish the other project
    include __DIR__.'/arba.php';
*/

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
