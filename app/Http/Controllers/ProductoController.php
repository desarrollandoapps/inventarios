<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = App\Producto::orderby('nombre', 'asc')->get();
        return view ('producto.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('producto.insert');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'cantidad' => 'required',
            'precioUnitario' => 'required',
        ]);

        App\Producto::create($request->all());

        return redirect()->route('productoIndex')
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
        $producto = App\Producto::FindorFail($id);
        return view('producto.view', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = App\Producto::FindorFail($id);
        return view('producto.edit', compact('producto'));
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
        $producto = App\Producto::FindorFail($id);
        $producto->update($request->all());

        return redirect()->route('productoIndex')
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
