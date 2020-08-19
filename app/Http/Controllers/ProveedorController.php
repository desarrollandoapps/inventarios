<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores = App\Proveedor::orderby('nombre', 'asc')->paginate(10);
        return view ('configuracion.proveedor.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('configuracion.proveedor.insert');
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
            'descuento.required' => 'Debe ingresar el descuento.',
            'tiemposEntrega.required' => 'Debe ingresar la información acerca de los tiempos de entrega.',
            'devoluciones.required' => 'Debe ingresar la información acerca de las devoluciones.',
        ];

        // Validar que los campos obligatorios tengan valor
        $validator = Validator::make($request->all(), [
            'nit'=>'required',
            'nombre' => 'required|unique:proveedors',
            'telefono' => 'required',
            'direccion' => 'required',
            'formaPago' => 'required',
            'descuento' => 'required',
            'tiemposEntrega' => 'required',
            'devoluciones' => 'required',
        ], $mensajes);

        if ($validator->fails()) {
            return redirect('proveedor/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        App\Proveedor::create($request->all());

        return redirect()->route('proveedor.index')
                        ->with('exito', 'Proveedor creado exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proveedor = App\Proveedor::FindorFail($id);
        return view('configuracion.proveedor.view', compact('proveedor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proveedor = App\Proveedor::FindorFail($id);
        return view('configuracion.proveedor.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mensajes = [
            'nombre.required' => 'Debe ingresar el nombre.',
            'telefono.required' => 'Debe ingresar el teléfono.',
            'direccion.required' => 'Debe ingresar la dirección.',
            'formaPago.required' => 'Debe ingresar la forma de pago.',
            'descuento.required' => 'Debe ingresar el descuento.',
            'tiemposEntrega.required' => 'Debe ingresar la información acerca de los tiempos de entrega.',
            'devoluciones.required' => 'Debe ingresar la información acerca de las devoluciones.',
        ];

        // Validar que los campos obligatorios tengan valor
        $validator = Validator::make($request->all(), [
            'nit'=>'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'formaPago' => 'required',
            'descuento' => 'required',
            'tiemposEntrega' => 'required',
            'devoluciones' => 'required',
        ], $mensajes);

        if ($validator->fails()) {
            return redirect('proveedor/' . $id . '/edit')
                        ->withErrors($validator)
                        ->withInput();
        }
        $proveedor = App\Proveedor::FindorFail($id);
        $proveedor->update($request->all());

        return redirect()->route('proveedor.index')
                        ->with('exito', 'Proveedor modificado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proveedor = App\Proveedor::FindorFail($id);
        try {
            $proveedor->delete();
            return redirect()->route('proveedor.index')
                             ->with('exito', 'Proveedor eliminado exitosamente!');
        }catch (\Illuminate\Database\QueryException $e){
            return redirect()->route('proveedor.index')
                         ->with('fallo', 'No se pudo eliminar el proveedor');
        }
    }
}
