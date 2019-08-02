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

Route::get('/', 'InicioController@index');
//Route::get('admin/permiso', 'admin\PermisoControler@index')->name('permiso'); //se puede realizar chache de esta forma
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    //permisos
    Route::get('permiso', 'PermisoController@index')->name('permiso');
    Route::get('permiso/crear', 'PermisoController@crear')->name('crear_permiso');
    //Menús
    Route::get('menu', 'MenuController@index')->name('menu');
    Route::get('menu/crear','MenuController@crear')->name('crear_menu');
    Route::post('menu','MenuController@guardar')->name('guardar_menu');

});
