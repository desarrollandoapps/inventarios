<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = App\Producto::orderby('nombre', 'asc')->paginate(10);
        return view ('configuracion.producto.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = App\Categoria::select('nombre', 'id')->orderby('nombre', 'asc')->get();
        return view('configuracion.producto.insert', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mensajes = [
            'idCategoria.required' => 'Debe seleccionar una categoría.',
            'nombre.unique' => 'Ya hay una categoría con el nombre que intenta asignar.',
            'nombre.required' => 'Debe ingresar el nombre.',
            'cantidad.required' => 'Debe ingresar la cantidad.',
            'precioUnitario.required' => 'Debe ingresar el precio unitario.',
        ];

        // Validar que los campos obligatorios tengan valor
        $validator = Validator::make($request->all(), [
            'idCategoria'=>'required',
            'nombre' => 'required|unique:productos',
            'cantidad' => 'required',
            'precioUnitario' => 'required',
        ], $mensajes);

        if ($validator->fails()) {
            return redirect('producto/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        App\Producto::create($request->all());

        return redirect()->route('producto.index')
                        ->with('exito', 'Producto creado exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = App\Producto::join('categorias', 'productos.idCategoria', 'categorias.id')
                        ->select('productos.*', 'categorias.nombre as categoria')
                        ->where('productos.id', $id)
                        ->first();
        // $producto = App\Producto::FindorFail($id);
        return view('configuracion.producto.view', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorias = App\Categoria::select('nombre', 'id')->orderby('nombre', 'asc')->get();
        $producto = App\Producto::FindorFail($id);
        return view('configuracion.producto.edit', compact('producto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mensajes = [
            'idCategoria.required' => 'Debe seleccionar una categoría.',
            'nombre.required' => 'Debe ingresar el nombre.',
            'cantidad.required' => 'Debe ingresar la cantidad.',
            'precioUnitario.required' => 'Debe ingresar el precio unitario.',
        ];

        // Validar que los campos obligatorios tengan valor
        $validator = Validator::make($request->all(), [
            'idCategoria'=>'required',
            'cantidad' => 'required',
            'precioUnitario' => 'required',
        ], $mensajes);

        if ($validator->fails()) {
            return redirect('producto/' . $id . '/edit')
                        ->withErrors($validator)
                        ->withInput();
        }
        $producto = App\Producto::FindorFail($id);
        $producto->update($request->all());

        return redirect()->route('producto.index')
                        ->with('exito', 'Producto modificado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = App\Producto::FindorFail($id);
        try {
            $producto->delete();
            return redirect()->route('productoIndex')
                             ->with('exito', 'Producto eliminado exitosamente!');
        }catch (\Illuminate\Database\QueryException $e){
            return redirect()->route('productoIndex')
                         ->with('fallo', 'No se pudo eliminar el producto');
        }
    }
}
