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
    
    Route::group(['prefix' => 'editor'], function () {
        Route::get('/{id}', 'ProjetoController@editarProjeto')->name('editarProjeto');
        Route::post('/salvarAlteracao', 'ProjetoController@salvarAlteracao')->name('salvarAlteracao');
    });
});