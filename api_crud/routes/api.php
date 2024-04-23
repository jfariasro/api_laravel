<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    Route::resource('personas', 'Api\V1\PersonaController');
    Route::post('personas/{id}', 'Api\V1\PersonaController@update');
    Route::delete('personas/{id}', 'Api\V1\PersonaController@destroy');

    Route::resource('usuarios', 'Api\V1\UsuarioController');
    Route::post('usuarios/{id}', 'Api\V1\UsuarioController@update');
    Route::delete('usuarios/{id}', 'Api\V1\UsuarioController@destroy');

});