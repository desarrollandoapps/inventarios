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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::put('/profile', 'ProfileController@update')->name('profile.update');
    
    Route::get('/about', function () {
        return view('about');
    })->name('about');
    
    Route::get('proveedores', 'ProveedorController@index')->name('proveedor.index');
    Route::post('proveedor-import-list-excel', 'ProveedorController@importExcel')->name('proveedor.import.excel');
    
    Route::get('productos', 'ProductoController@index')->name('producto.index');
    Route::post('producto-import-list-excel', 'ProductoController@importExcel')->name('producto.import.excel');
    
    Route::get('ventas', 'VentaController@index')->name('venta.index');
    Route::post('venta-insert', 'VentaController@insert')->name('venta.insert');
    Route::post('venta-import-list-excel', 'VentaController@importExcel')->name('venta.import.excel');
    
    Route::get('analisis/filtro', 'AnalisisController@verFiltro')->name('analisis.filtro');
    Route::post('analisis/filtrar', 'AnalisisController@filtrar')->name('analisis.filtrar');
    Route::get('analisis/filtrado', 'AnalisisController@filtrar')->name('analisis.filtrado');
});