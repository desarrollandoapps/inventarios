<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = App\Cliente::orderby('nombre', 'asc')->paginate(10);
        return view('configuracion.cliente.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('configuracion.cliente.insert');
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
            'nombre.required' => 'Debe ingresar el nombre.',
            'nombre.unique' => 'Ya hay un proveedor con el nombre que intenta asignar.',
            'telefono.required' => 'Debe ingresar el teléfono.',
            'direccion.required' => 'Debe ingresar la dirección.',
            'formaPago.required' => 'Debe ingresar la forma de pago.',
        ];

        // Validar que los campos obligatorios tengan valor
        $validator = Validator::make($request->all(), [
            'nit'=>'required',
            'nombre' => 'required|unique:clientes',
            'telefono' => 'required',
            'direccion' => 'required',
            'formaPago' => 'required',
        ], $mensajes);

        if ($validator->fails()) {
            return redirect('cliente/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        App\Cliente::create($request->all());

        return redirect()->route('cliente.index')
                        ->with('exito', 'Cliente creado exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = App\Cliente::FindorFail($id);
        return view('configuracion.cliente.view', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = App\Cliente::FindorFail($id);
        return view('configuracion.cliente.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mensajes = [
            'nombre.required' => 'Debe ingresar el nombre.',
            'telefono.required' => 'Debe ingresar el teléfono.',
            'direccion.required' => 'Debe ingresar la dirección.',
            'formaPago.required' => 'Debe ingresar la forma de pago.',
        ];

        // Validar que los campos obligatorios tengan valor
        $validator = Validator::make($request->all(), [
            'nit'=>'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'formaPago' => 'required',
        ], $mensajes);

        if ($validator->fails()) {
            return redirect('cliente/' . $id . '/edit')
                        ->withErrors($validator)
                        ->withInput();
        }
        $cliente = App\Cliente::FindorFail($id);
        $cliente->update($request->all());

        return redirect()->route('cliente.index')
                        ->with('exito', 'Cliente modificado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = App\Cliente::FindorFail($id);
        try {
            $cliente->delete();
            return redirect()->route('cliente.index')
                             ->with('exito', 'Cliente eliminado exitosamente!');
        }catch (\Illuminate\Database\QueryException $e){
            return redirect()->route('cliente.index')
                         ->with('fallo', 'No se pudo eliminar el cliente');
        }
    }
}
