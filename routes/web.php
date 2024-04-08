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

Route::group(['prefix' => 'arba'], function() {
    Route::get('/login', [ArbaUserController::class, 'getLogin']);
    Route::post('/login', [ArbaUserController::class, 'postLogin'])->name('arba.login');
    Route::post('/logout', [ArbaUserController::class, 'destroy'])->name('arba.logout');
    Route::group(['middleware' => 'arba_user'], function() {
        Route::get('/dashboard', function() {
            return view('arba.dashboard.paneles');
        })->name('dashboard.arba');
        Route::get('/socio/create', [\App\Http\Controllers\SocioController::class, 'getCreate']);
        Route::get('/socio/usuario', [\App\Http\Controllers\SocioController::class,'getUser']);
        Route::post('/socio/create', [\App\Http\Controllers\SocioController::class, 'store'])->name('arba.socio.create');
        Route::post('/socio/usuario', [\App\Http\Controllers\SocioController::class, 'postUser'])->name('arba.user');
    });
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
