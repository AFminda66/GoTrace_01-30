<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', function (Request $request) {
    return view('/login');
});

Route::post('/login_chek', [UserController::class, 'login_chek']);

Route::get('/datosUsuario', [UserController::class, 'datosUsuario'])->name('dashboard');;

Route::post('/datosUsuario/guardar', [UserController::class, 'guardarUsuario']);
Route::post('/datosUsuario/editar', [UserController::class, 'editarUsuario']);

Route::get('/rutasUsuario', [UserController::class, 'rutasUsuario']);