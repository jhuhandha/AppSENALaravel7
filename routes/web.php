<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'LandingController@index');
Route::get('/nueva', 'LandingController@nueva');


Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get("/prueba/juan", "PruebaController@index");

    Route::resource('categorias', 'CategoriaController');

    Route::get('/producto', 'ProductoController@index');
    Route::get('/producto/listar', 'ProductoController@listar');
    Route::get('/producto/crear', 'ProductoController@create');
    Route::post('/producto/guardar', 'ProductoController@save');
    Route::get('/producto/editar/{id}', 'ProductoController@edit');
    Route::post('/producto/actualizar', 'ProductoController@update');
    Route::get('/producto/cambiar/estado/{id}/{estado}', 'ProductoController@updateState');


    Route::get('/agenda', 'AgendaController@index');
    Route::get('/agenda/listar', 'AgendaController@listar');
    Route::post('/agenda/guardar', 'AgendaController@guardar');


    Route::get('/agenda/informe', 'AgendaController@informe');
    Route::post('/agenda/generar/informe', 'AgendaController@generar_informe');
});

