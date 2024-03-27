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
    return view('welcome');
});

Route::get('/arba/login', [ArbaUserController::class, 'getLogin']);

Route::post('/arba/login', [ArbaUserController::class, 'postLogin'])->name('arba.login');

Route::post('/arba/logout', [ArbaUserController::class, 'destroy']);

Route::get('/prueba', function() {
    return 'Hola, si estás leyendo esto es porque la ruta funciona correctamente';
})->middleware('arba_user');
