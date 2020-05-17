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
Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('/novoProjeto', 'ProjetoController@novoProjeto')->name('novoProjeto');
    Route::post('/colaborarProjeto', 'ProjetoController@colaborarProjeto')->name('colaborarProjeto');
    Route::get('/logs/{id}', 'ProjetoController@verLogs')->name('verLogs');
    
    Route::group(['prefix' => 'editor'], function () {
        Route::get('/project/{id}', 'ProjetoController@editarProjeto')->name('editarProjeto');
        Route::get('/verificarSessao', 'ProjetoController@verificarSessao')->name('verificarSessao');
        Route::post('/salvarAlteracao', 'ProjetoController@salvarAlteracao')->name('salvarAlteracao');
    });
});