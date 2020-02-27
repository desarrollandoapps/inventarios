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

Route::get('configuracion/index', function () {
    return view('configuracion/index');
})->name('configuracion');

Route::get('cliente/index', function () {
    return view('cliente/index');
})->name('clientes');

Route::get('presentacion/index', function () {
    $presentaciones = App\Presentacion::orderby('descripcion', 'asc')->get();
    return view ('presentacion.index', compact('presentaciones'));
})->name('presentacionIndex');

Route::resource('presentacion', 'PresentacionController');

Route::get('producto/index', function () {
    $productos = App\Producto::orderby('nombre', 'asc')->get();
    return view ('producto.index', compact('productos'));
})->name('productoIndex');

Route::resource('producto', 'ProductoController');

Route::get('paquete/index', function () {
    $paquetes = App\Subproducto::join('productos', 'subproductos.idProducto', '=', 'productos.id')
                        ->join('presentacions', 'subproductos.idPresentacion', '=', 'presentacions.id')
                        ->select('productos.id as idProducto', 'presentacions.id as idPresentacion', 'productos.nombre as nombreProducto','presentacions.descripcion as presentacion', 'subproductos.unidades as unidades')
                        ->orderby('productos.nombre','asc')
                        ->get();
    return view ('paquete.index', compact('paquetes'));
})->name('paqueteIndex');

Route::resource('paquete', 'PaqueteController');

Route::get('paquete/show/{idProducto}/{idPresentacion}', [
    'as' => 'datos',
    'uses' => 'PaqueteController@show'
]);

Route::get('paquete/destroy/{idProducto}/{idPresentacion}', [
    'as' => 'datos',
    'uses' => 'PaqueteController@destroy'
]);

Route::get('producto/destroy/{id}', 'ProductoController@destroy')->name('borrarProducto');

Route::get('presentacion/destroy/{id}', 'PresentacionController@destroy')->name('borrarPresentacion');

Route::get('paquete/destroy/{idProducto}/{idPresentacion}', 'PaqueteController@destroy')->name('borrarPaquete');

Route::resource('proveedor', 'ProveedorController');

Route::get('proveedor/', function () {
    $proveedores = App\Proveedor::orderby('nombre', 'asc')->get();
    return view ('proveedor.index', compact('proveedores'));
})->name('proveedorIndex');