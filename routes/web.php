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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::resource('categoria', 'CategoriaController');
Route::resource('producto', 'ProductoController');
Route::resource('presentacion', 'PresentacionController');
Route::resource('paquete', 'PaqueteController');
Route::resource('proveedor', 'ProveedorController');
Route::resource('cliente', 'ClienteController');

Route::get('configuracion/index', function () {
    return view('configuracion/index');
})->name('configuracion');

Route::get('categoria/destroy/{id}', 'CategoriaController@destroy')->name('borrarCategoria');
Route::get('producto/destroy/{id}', 'ProductoController@destroy')->name('borrarProducto');
Route::get('presentacion/destroy/{id}', 'PresentacionController@destroy')->name('borrarPresentacion');
Route::get('paquete/destroy/{idProducto}/{idPresentacion}', 'PaqueteController@destroy')->name('borrarPaquete');
Route::get('proveedor/destroy/{id}', 'ProveedorController@destroy')->name('borrarProveedor');
Route::get('cliente/destroy/{id}', 'ClienteController@destroy')->name('borrarCliente');