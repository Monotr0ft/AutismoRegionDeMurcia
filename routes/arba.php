<?php

use App\Http\Controllers\ArbaUserController;
use App\Http\Controllers\SocioController;
use App\Http\Controllers\StockPlantaController;
use App\Http\Controllers\ProyectoController;

Route::group(['prefix' => 'arba'], function() {
    Route::get('/login', [ArbaUserController::class, 'getLogin']);
    Route::get('/verificaremail/{email}', [ArbaUserController::class, 'getVerificarEmail']);
    Route::get('/olvidecontrasenia', [ArbaUserController::class, 'getRecuperarContrasenia']);
    Route::get('/cambiocontrasenia/{token}', [ArbaUserController::class, 'getResetContrasenia']);
    Route::post('/olvidecontrasenia', [ArbaUserController::class, 'postRecuperarContrasenia'])->name('arba.olvidecontrasenia');
    Route::post('/cambiocontrasenia/{token}', [ArbaUserController::class, 'postActualizarContrasenia'])->name('arba.cambiocontrasenia');
    Route::post('/login', [ArbaUserController::class, 'postLogin'])->name('arba.login');
    Route::post('/logout', [ArbaUserController::class, 'destroy'])->name('arba.logout');
    Route::group(['middleware' => 'arba_user'], function() {
        Route::get('/dashboard', function() {
            return view('arba.dashboard.paneles');
        })->name('dashboard.arba');
        Route::get('/perfil', [ArbaUserController::class, 'getUsuario'])->name('arba.perfil');
        Route::post('/perfil/{email}', [ArbaUserController::class, 'postMailVerificacion']);
        Route::put('/perfil', [ArbaUserController::class, 'updatePassword'])->name('arba.perfil.password');
        Route::group(['middleware' => 'administracion_arba'], function() {
            Route::get('/administracion', function() {
                return view('arba.dashboard.paneles.administracion');
            })->name('arba.administracion');
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
            Route::group(['prefix' => 'proyecto'], function() {
                Route::get('/', [ProyectoController::class, 'index'])->name('arba.proyecto');
                Route::get('{id}', [ProyectoController::class, 'show'])->name('arba.proyecto.show')->where('id', '[0-9]+');
                Route::get('edit/{id}', [ProyectoController::class, 'getEdit'])->where('id', '[0-9]+');
                Route::get('create', [ProyectoController::class, 'getCreate']);
                Route::post('create', [ProyectoController::class, 'store'])->name('arba.proyecto.create');
                Route::delete('delete/{id}', [ProyectoController::class, 'destroy'])->name('arba.proyecto.delete')->where('id', '[0-9]+');
                Route::put('edit/{id}', [ProyectoController::class, 'update'])->name('arba.proyecto.edit')->where('id', '[0-9]+');
            });
        });
        Route::group(['middleware' => 'vivero_arba'], function() {
            Route::get('/vivero', function() {
                return view('arba.dashboard.paneles.vivero');
            })->name('arba.vivero');
            Route::group(['prefix' => 'stock'], function() {
                Route::get('/', [StockPlantaController::class, 'index'])->name('arba.stock');
                Route::get('/create', [StockPlantaController::class, 'getCreate']);
                Route::get('/{id}', [StockPlantaController::class, 'show'])->name('arba.stock.show')->where('id', '[0-9]+');
                Route::get('/edit/{id}', [StockPlantaController::class, 'getEdit'])->where('id', '[0-9]+');
                Route::post('/create', [StockPlantaController::class, 'store'])->name('arba.stock.create');
                Route::delete('/delete/{id}', [StockPlantaController::class, 'destroy'])->name('arba.stock.delete')->where('id', '[0-9]+');
                Route::put('/edit/{id}', [StockPlantaController::class, 'update'])->name('arba.stock.edit')->where('id', '[0-9]+');
            });
        });
    });
});