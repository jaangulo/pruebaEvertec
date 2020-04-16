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

Route::get('/', function () {
    // llama a la  plantilla que se llama principal que se encuentra en la carperta view
   // return view('principal');

   //la plantilla que voy a visualizar esta en la carpeta contenido y el archivo contenido
    return view('contenido/contenido');

    
});


Route::post('/pago/registrar', 'PagoController@store');

Route::get('/personas', 'PersonaController@index');
Route::get('/pago/actualizar', 'PagoController@update');

