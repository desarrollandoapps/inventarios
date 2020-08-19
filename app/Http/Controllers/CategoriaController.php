<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = App\Categoria::orderBy('nombre', 'asc')->paginate(10);
        return view('configuracion.categoria.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('configuracion.categoria.insert');
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
        ]);

        App\Categoria::create($request->all());

        return redirect()->route('categoria.index')
                        ->with('exito', 'Categoría creada exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoria = App\Categoria::FindorFail($id);
        return view('configuracion.categoria.view', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria = App\Categoria::FindorFail($id);
        return view('configuracion.categoria.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
        ]);
        $categoria = App\Categoria::FindorFail($id);
        $categoria->update($request->all());

        return redirect()->route('categoria.index')
                        ->with('exito', 'Categoría modificada exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = App\Categoria::FindorFail($id);
        try {
            $categoria->delete();
            return redirect()->route('categoria.index')
                             ->with('exito', 'Categoría eliminada exitosamente!');
        }catch (\Illuminate\Database\QueryException $e){
            return redirect()->route('categoria.uindex')
                         ->with('fallo', 'No se pudo eliminar la categoría');
        }
    }
}
