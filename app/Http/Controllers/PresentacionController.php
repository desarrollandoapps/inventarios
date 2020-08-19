<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;

class PresentacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $presentaciones = App\Presentacion::orderby('descripcion', 'asc')->paginate(10);
        return view ('configuracion.presentacion.index', compact('presentaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('configuracion.presentacion.insert');
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
            'descripcion' => 'required'
        ]);

        App\Presentacion::create($request->all());

        return redirect()->route('presentacion.index')
                        ->with('exito', '¡Presentación creada exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Presentacion  $presentacion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $presentacion = App\Presentacion::FindorFail($id);
        return view('configuracion.presentacion.view', compact('presentacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Presentacion  $presentacion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $presentacion = App\Presentacion::FindorFail($id);
        return view('configuracion.presentacion.edit', compact('presentacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Presentacion  $presentacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $presentacion = App\Presentacion::FindorFail($id);

        $request->validate([
            'descripcion' => 'required'
        ]);

        $presentacion->update($request->all());
        return redirect()->route('presentacion.index')
                        ->with('exito', '¡Presentación modificada exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Presentacion  $presentacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $presentacion = App\Presentacion::FindorFail($id);
        try {
            $presentacion->delete();
            return redirect()->route('presentacion.index')
                             ->with('exito', 'Presentación eliminada exitosamente!');
        } catch (\Illuminate\Database\QueryException $e){
            return redirect()->route('presentacion.index')
                         ->with('fallo', 'No se pudo eliminar la presentación');
        }
    }
}