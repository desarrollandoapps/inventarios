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
    Route::delete('venta-delete/{id}', 'VentaController@delete')->name('venta.delete');
    Route::post('venta-import-list-excel', 'VentaController@importExcel')->name('venta.import.excel');
    
    Route::get('analisis/filtro', 'AnalisisController@verFiltro')->name('analisis.filtro');
    Route::post('analisis/filtrar', 'AnalisisController@filtrar')->name('analisis.filtrar');
    Route::get('analisis/filtrado', 'AnalisisController@filtrar')->name('analisis.filtrado');
    Route::get('filtrado-export-excel', 'AnalisisController@filtradoExportExcel')->name('filtrado.export.excel');
    
    Route::get('analisis/ver-abc', 'AnalisisController@verAbc')->name('analisis.verAbc');
    Route::post('analisis/abc', 'AnalisisController@clasificacionABC')->name('analisis.clasificacionABC');
    Route::get('analisis/abc-export-excel', 'AnalisisController@abcExportExcel')->name('abc.export.excel');
    Route::get('analisis/abc-graficar', 'AnalisisController@graficarABC')->name('abc.graficar');
    Route::get('analisis/abc-grafico', 'AnalisisController@graficoABC')->name('abc.grafico');
    
    Route::get('analisis/ver-xyz', 'AnalisisController@verXyz')->name('analisis.verXyz');
    Route::post('analisis/xyz', 'AnalisisController@clasificacionXYZ')->name('analisis.clasificacionXYZ');
    Route::get('analisis/xyz-export-excel', 'AnalisisController@xyzExportExcel')->name('xyz.export.excel');
    
    Route::get('analisis/ver-abcxyz', 'AnalisisController@verAbcXyz')->name('analisis.verAbcXyz');
    Route::post('analisis/abcxyz', 'AnalisisController@clasificacionABCXYZ')->name('analisis.clasificacionABCXYZ');
    Route::get('analisis/full-export-excel', 'AnalisisController@fullExportExcel')->name('full.export.excel');

    Route::get('analisis/ver-recomendaciones', 'AnalisisController@verRecomendaciones')->name('analisis.verRecomendaciones');
});