<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArbaUserController;
use App\Http\Controllers\SocioController;
use App\Http\Controllers\AsociacionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StockPlantaController;
use App\Http\Controllers\AsociacionNuevaController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\PaginaController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\NewsletterController;

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

Route::get('/newsletter/{token}', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter');
Route::post('/upload', [ImageUploadController::class, 'upload'])->name('upload');
Route::post('/delete-image', [ImageUploadController::class, 'deleteImage'])->name('delete-image');
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
        Route::post('publicar/{id}', [AsociacionController::class, 'publicar'])->name('dashboard.asociaciones.publicar')->where('id', '[0-9]+');
        Route::post('ocultar/{id}', [AsociacionController::class, 'ocultar'])->name('dashboard.asociaciones.ocultar')->where('id', '[0-9]+');
    });
    Route::group(['prefix' => 'asociacionesnuevas'], function() {
        Route::get('/', [AsociacionNuevaController::class, 'index'])->name('dashboard.asociacionesnuevas');
        Route::get('/{id}', [AsociacionNuevaController::class, 'show'])->name('dashboard.asociacionesnuevas.show')->where('id', '[0-9]+');
        Route::get('edit/{id}', [AsociacionNuevaController::class, 'getEdit'])->where('id', '[0-9]+');
        Route::put('edit/{id}', [AsociacionNuevaController::class, 'update'])->name('dashboard.asociacionesnuevas.edit')->where('id', '[0-9]+');
        Route::delete('delete/{id}', [AsociacionNuevaController::class, 'destroy'])->name('dashboard.asociacionesnuevas.delete')->where('id', '[0-9]+');
        Route::post('publicar/{id}', [AsociacionNuevaController::class, 'publicar'])->name('dashboard.asociacionesnuevas.publicar')->where('id', '[0-9]+');
        Route::post('ocultar/{id}', [AsociacionNuevaController::class, 'ocultar'])->name('dashboard.asociacionesnuevas.ocultar')->where('id', '[0-9]+');
    });
    Route::group(['prefix' => 'paginas'], function() {
        Route::get('/', [PaginaController::class, 'index'])->name('dashboard.paginas');
        Route::get('/create', [PaginaController::class, 'getCreate'])->name('dashboard.paginas.create');
        Route::get('/{id}', [PaginaController::class, 'show'])->name('dashboard.paginas.show')->where('id', '[0-9]+');
        Route::get('/edit/{id}', [PaginaController::class, 'getEdit'])->where('id', '[0-9]+');
        Route::post('/create', [PaginaController::class, 'store'])->name('dashboard.paginas.store');
        Route::put('/edit/{id}', [PaginaController::class, 'edit'])->name('dashboard.paginas.edit')->where('id', '[0-9]+');
        Route::delete('/delete/{id}', [PaginaController::class, 'delete'])->name('dashboard.paginas.delete')->where('id', '[0-9]+');
    });
    Route::group(['prefix' => 'noticias'], function() {
        Route::get('/', [NoticiaController::class, 'index'])->name('dashboard.noticias');
        Route::get('/create', [NoticiaController::class, 'getCreate'])->name('dashboard.noticias.create');
        Route::get('/edit/{id}', [NoticiaController::class, 'getEdit'])->name('dashboard.noticias.edit')->where('id', '[0-9]+');
        Route::post('/create', [NoticiaController::class, 'store'])->name('dashboard.noticias.store');
        Route::put('/edit/{id}', [NoticiaController::class, 'update'])->name('dashboard.noticias.update')->where('id', '[0-9]+');
        Route::delete('/delete/{id}', [NoticiaController::class, 'destroy'])->name('dashboard.noticias.delete')->where('id', '[0-9]+');
    });
})->middleware('auth');

Route::group(['prefix' => 'asociaciones'], function() {
    Route::get('/', [AsociacionController::class, 'getAsociaciones'])->name('asociaciones');
    Route::get('/formulario', [AsociacionController::class, 'getCreate']);
    Route::post('/formulario', [AsociacionNuevaController::class, 'store'])->name('asociaciones.create');
});

Route::get('/noticias', [NoticiaController::class, 'getNoticias'])->name('noticias');

Route::get('/queesarm', [PaginaController::class, 'arm'])->name('queesarm');

Route::get('/autismo', [PaginaController::class, 'autismo'])->name('autismo');

Route::get('/recursos', function () {
    return view('autismo.paginas.recursos');
})->name('recursos');

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

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
