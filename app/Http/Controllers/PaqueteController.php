<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;

class PaqueteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paquetes = App\Subproducto::join('productos', 'subproductos.idProducto', '=', 'productos.id')
                        ->join('presentacions', 'subproductos.idPresentacion', '=', 'presentacions.id')
                        ->select('productos.id as idProducto', 'presentacions.id as idPresentacion', 'productos.nombre as nombreProducto','presentacions.descripcion as presentacion', 'subproductos.unidades as unidades')
                        ->orderby('productos.nombre','asc')
                        ->get();
        return view('paquete.index', compact('paquetes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos = App\Producto::select('nombre', 'id')->orderby('nombre', 'asc')->get();
        $presentaciones = App\Presentacion::select('descripcion', 'id')->orderby('descripcion', 'asc')->get();
        return view ('paquete.insert', compact('productos', 'presentaciones'));
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
            'idProducto' => 'required',
            'idPresentacion' => 'required',
            'unidades' => 'required',
        ]);

        App\Subproducto::create($request->all());

        return redirect()->route('paquete.index')
                         ->with('exito', 'Paquete creado exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subproducto  $subproducto
     * @return \Illuminate\Http\Response
     */
    public function show($idProducto, $idPresentacion)
    {
        $paquete = App\Subproducto::join('productos', 'subproductos.idProducto', '=', 'productos.id')
                        ->join('presentacions', 'subproductos.idPresentacion', '=', 'presentacions.id')
                        ->select('productos.id as idProducto', 'presentacions.id as idPresentacion', 'productos.nombre as nombreProducto','presentacions.descripcion as presentacion', 'subproductos.unidades as unidades')
                        ->where([['idProducto', $idProducto], ['idPresentacion', $idPresentacion]])
                        ->orderby('productos.nombre','asc')
                        ->get();
        return view('paquete.view', compact('paquete'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subproducto  $subproducto
     * @return \Illuminate\Http\Response
     */
    public function edit($idProducto, $idPresentacion)
    {
        $paquete = App\Subproducto::where('idProducto', $idProducto)->where('idPresentacion', $idPresentacion)->get();
        $productos = App\Producto::select('nombre', 'id')->orderby('nombre', 'asc')->get();
        $presentaciones = App\Presentacion::select('descripcion', 'id')->orderby('descripcion', 'asc')->get();
        return view('paquete.edit', compact('paquete', 'productos', 'presentaciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subproducto  $subproducto
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subproducto  $subproducto
     * @return \Illuminate\Http\Response
     */
    public function destroy($idProducto, $idPresentacion)
    {
        try {
            $paquete = App\Subproducto::where('idProducto', $idProducto)->where('idPresentacion', $idPresentacion)->delete();
            return redirect()->route('paquete.index')
                             ->with('exito', 'Paquete eliminado exitosamente!');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('paquete.index')
                         ->with('fallo', 'No se pudo eliminar el paquete');
        }
    }
}
