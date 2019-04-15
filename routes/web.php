<?php

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

Route::get('/', ['uses' => 'page\GdsController@index', 'as' => 'index']);

Auth::routes();

Route::group(['middleware' => 'auth', 'prefix' => 'adm'], function() {
    Route::get('/', 'adm\AdmController@index');
    Route::get('logout', ['uses' => 'adm\AdmController@logout' , 'as' => 'adm.logout']);
    /**
     * CONTENIDO
     */
    Route::group(['prefix' => 'contenido', 'as' => 'contenido'], function() {
        Route::get('{seccion}/index', ['uses' => 'adm\ContenidoController@index', 'as' => '.index']);
        Route::get('{seccion}/edit', ['uses' => 'adm\ContenidoController@edit', 'as' => '.edit']);
        Route::post('{seccion}/update', ['uses' => 'adm\ContenidoController@update', 'as' => 'update']);
    });
    /**
     * SLIDERS
     */
    Route::group(['prefix' => 'slider', 'as' => 'slider'], function() {
        Route::get('{seccion}/index', ['uses' => 'adm\SliderController@index', 'as' => '.index']);
        Route::post('{seccion}/store', ['uses' => 'adm\SliderController@store', 'as' => '.store']);
        Route::get('edit/{id}', ['uses' => 'adm\SliderController@edit', 'as' => '.edit']);
        Route::get('delete/{id}', ['uses' => 'adm\SliderController@destroy', 'as' => '.destroy']);
        Route::post('update/{id}', ['uses' => 'adm\SliderController@update', 'as' => 'update']);
    });
    /**
     * CLIENTES
     */
    Route::group(['prefix' => 'cliente', 'as' => 'cliente'], function() {
        Route::get('index', ['uses' => 'adm\ClienteController@index', 'as' => '.index']);
        Route::get('clientes', ['uses' => 'adm\ClienteController@clientes', 'as' => '.clientes']);
        Route::post('store', ['uses' => 'adm\ClienteController@store', 'as' => '.store']);
        Route::get('edit/{id}', ['uses' => 'adm\ClienteController@edit', 'as' => '.edit']);
        Route::get('delete/{id}', ['uses' => 'adm\ClienteController@destroy', 'as' => '.destroy']);
        Route::post('update/{id}', ['uses' => 'adm\ClienteController@update', 'as' => 'update']);
    });
    /**
     * RRHH
     */
    Route::group(['prefix' => 'rrhh', 'as' => 'rrhh'], function() {
        Route::get('index', ['uses' => 'adm\RRHHcontroller@index', 'as' => '.index']);
        Route::post('store', ['uses' => 'adm\RRHHcontroller@store', 'as' => '.store']);
        Route::get('edit/{id}', ['uses' => 'adm\RRHHcontroller@edit', 'as' => '.edit']);
        Route::get('delete/{id}', ['uses' => 'adm\RRHHcontroller@destroy', 'as' => '.destroy']);
        Route::post('update/{id}', ['uses' => 'adm\RRHHcontroller@update', 'as' => 'update']);
    });
    /**
     * ARCHIVO
     */
    Route::group(['prefix' => 'archivo', 'as' => 'archivo'], function() {
        Route::get('index/{seccion}', ['uses' => 'adm\ArchivoController@index', 'as' => '.index']);
        Route::post('store/{seccion}', ['uses' => 'adm\ArchivoController@store', 'as' => '.store']);
        Route::get('edit/{id}', ['uses' => 'adm\ArchivoController@edit', 'as' => '.edit']);
        Route::get('delete/{id}', ['uses' => 'adm\ArchivoController@destroy', 'as' => '.destroy']);
        Route::post('update/{id}', ['uses' => 'adm\ArchivoController@update', 'as' => 'update']);
    });

    /**
     * PROYECTOS
     */
    Route::group(['prefix' => 'proyecto', 'as' => 'proyecto'], function() {
        Route::get('index', ['uses' => 'adm\ProyectoController@index', 'as' => '.index']);
        Route::post('store', ['uses' => 'adm\ProyectoController@store', 'as' => '.store']);
        Route::get('edit/{id}', ['uses' => 'adm\ProyectoController@edit', 'as' => '.edit']);
        Route::get('delete/{id}', ['uses' => 'adm\ProyectoController@destroy', 'as' => '.destroy']);
        Route::post('update/{id}', ['uses' => 'adm\ProyectoController@update', 'as' => 'update']);
    });
    /**
     * PRODUCTOS
     */
    Route::group(['prefix' => 'familia', 'as' => 'familia'], function() {
        Route::get('/', ['uses' => 'adm\FamiliaController@index', 'as' => '.index']);
        Route::get('edit/{id}', ['uses' => 'adm\FamiliaController@edit', 'as' => '.edit']);
        Route::post('update/{id}', ['uses' => 'adm\FamiliaController@update', 'as' => '.update']);
        Route::post('store', ['uses' => 'adm\FamiliaController@store', 'as' => '.store']);
        Route::get('delete/{id}', ['uses' => 'adm\FamiliaController@destroy', 'as' => '.destroy']);

        Route::group(['prefix' => 'trabajo', 'as' => '.trabajo'], function() {
            Route::get('/', ['uses' => 'adm\TrabajoController@index', 'as' => '.index']);
            Route::get('edit/{id}', ['uses' => 'adm\TrabajoController@edit', 'as' => '.edit']);
            Route::post('update/{id}', ['uses' => 'adm\TrabajoController@update', 'as' => '.update']);
            Route::post('store', ['uses' => 'adm\TrabajoController@store', 'as' => '.store']);
            Route::get('delete/{id}', ['uses' => 'adm\TrabajoController@destroy', 'as' => '.destroy']);
        });
    });
    /**
     * DATOS GDS
     */
    Route::group(['prefix' => 'empresa', 'as' => 'empresa'], function() {
        Route::get('index', ['uses' => 'adm\EmpresaController@index', 'as' => '.index']);
        Route::get('metadatos', ['uses' => 'adm\EmpresaController@metadatos', 'as' => '.metadatos']);
        Route::get('metadato/{id}', ['uses' => 'adm\EmpresaController@metadato', 'as' => '.metadato']);
        Route::post('metadato/{id}', ['uses' => 'adm\EmpresaController@metadatoPOST', 'as' => '.metadato']);
        
        Route::get('usuarios', ['uses' => 'adm\EmpresaController@usuarios', 'as' => '.usuarios']);


        Route::get('mis_datos', ['uses' => 'adm\EmpresaController@mis_datos', 'as' => '.mis_datos']);
        Route::get('edit/{id}', ['uses' => 'adm\EmpresaController@edit', 'as' => '.edit']);
        Route::get('delete/{id}', ['uses' => 'adm\EmpresaController@destroy', 'as' => '.destroy']);
        Route::post('{seccion}/update', ['uses' => 'adm\EmpresaController@update', 'as' => 'update']);

        Route::group(['prefix' => 'usuario', 'as' => '.usuario'], function() {
            Route::get('/', ['uses' => 'adm\UserController@index', 'as' => '.index']);
            Route::get('edit/{id}', ['uses' => 'adm\UserController@edit', 'as' => '.edit']);
            Route::post('update/{id}', ['uses' => 'adm\UserController@update', 'as' => '.update']);
            Route::post('store', ['uses' => 'adm\UserController@store', 'as' => '.store']);
            Route::get('delete/{id}', ['uses' => 'adm\UserController@destroy', 'as' => '.destroy']);
        });
    });
});