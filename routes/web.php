<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArbaUserController;

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

Route::get('/', function () {
    return view('autismo.paginas.home');
})->name('home');

Route::group(['prefix' => 'asociaciones'], function() {
    Route::get('/', [\App\Http\Controllers\AsociacionController::class, 'index'])->name('asociaciones');
    Route::get('/formulario', [\App\Http\Controllers\AsociacionController::class, 'getCreate']);
    Route::post('/formulario', [\App\Http\Controllers\AsociacionController::class, 'store'])->name('asociaciones.create');
});

Route::group(['prefix' => 'arba'], function() {
    Route::get('/login', [ArbaUserController::class, 'getLogin']);
    Route::post('/login', [ArbaUserController::class, 'postLogin'])->name('arba.login');
    Route::post('/logout', [ArbaUserController::class, 'destroy'])->name('arba.logout');
    Route::group(['middleware' => 'arba_user'], function() {
        Route::get('/dashboard', function() {
            return view('arba.dashboard.paneles');
        })->name('dashboard.arba');
        Route::group(['prefix' => 'socio'], function() {
            Route::get('/', [\App\Http\Controllers\SocioController::class, 'index'])->name('arba.socio');
            Route::get('/{id}', [\App\Http\Controllers\SocioController::class, 'show']);
            Route::get('/{id}/edit', [\App\Http\Controllers\SocioController::class, 'edit']);
            Route::put('/{id}/edit', [\App\Http\Controllers\SocioController::class, 'update']);
            Route::delete('/{id}', [\App\Http\Controllers\SocioController::class, 'destroy']);
            Route::get('/create', [\App\Http\Controllers\SocioController::class, 'getCreate']);
            Route::get('/usuario', [\App\Http\Controllers\SocioController::class,'getUser']);
            Route::post('/create', [\App\Http\Controllers\SocioController::class, 'store'])->name('arba.socio.create');
            Route::post('/usuario', [\App\Http\Controllers\SocioController::class, 'postUser'])->name('arba.user');
        });
    });
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
