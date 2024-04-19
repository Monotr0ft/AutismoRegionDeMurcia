<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArbaUserController;
use App\Http\Controllers\SocioController;
use App\Http\Controllers\AsociacionController;
use App\Http\Controllers\UserController;

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

Route::get('/login', [UserController::class, 'getLogin']);
Route::post('/login', [UserController::class, 'postLogin'])->name('login');
Route::post('/logout', [UserController::class, 'postLogout'])->name('logout');
Route::group(['prefix' => 'dashboard'], function() {
    Route::get('/', [AsociacionController::class, 'index'])->name('dashboard');
    Route::group(['prefix' => 'asociaciones'], function() {
        Route::get('/{id}', [AsociacionController::class, 'show'])->name('dashboard.asociaciones.show')->where('id', '[0-9]+');
        Route::get('edit/{id}', [AsociacionController::class, 'getEdit'])->where('id', '[0-9]+');
        Route::put('edit/{id}', [AsociacionController::class, 'update'])->name('dashboard.asociaciones.edit')->where('id', '[0-9]+');
        Route::delete('delete/{id}', [AsociacionController::class, 'destroy'])->name('dashboard.asociaciones.delete')->where('id', '[0-9]+');
    });
})->middleware('auth');

Route::group(['prefix' => 'asociaciones'], function() {
    Route::get('/', [AsociacionController::class, 'getAsociaciones'])->name('asociaciones');
    Route::get('/formulario', [AsociacionController::class, 'getCreate']);
    Route::post('/formulario', [AsociacionController::class, 'store'])->name('asociaciones.create');
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
            Route::get('/', [SocioController::class, 'index'])->name('arba.socio');
            Route::get('{id}', [SocioController::class, 'show'])->name('arba.socio.show')->where('id', '[0-9]+');
            Route::get('edit/{id}', [SocioController::class, 'getEdit'])->name('arba.socio.edit')->where('id', '[0-9]+');
            Route::get('create', [SocioController::class, 'getCreate']);
            Route::get('usuario', [SocioController::class,'getUser']);
            Route::put('edit/{id}', [SocioController::class, 'update'])->name('arba.socio.edit')->where('id', '[0-9]+');
            Route::post('create', [SocioController::class, 'store'])->name('arba.socio.create');
            Route::delete('delete/{id}', [SocioController::class, 'destroy'])->name('arba.socio.delete')->where('id', '[0-9]+');
            Route::post('usuario', [SocioController::class, 'postUser'])->name('arba.user');
        });
    });
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
