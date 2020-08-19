@extends('layouts.layoutconfig')

@section('titulo', 'Detalle de proveedor')

@section('contenido')
    <h2 class="ui header">
        <i class="icon eye"></i>
        <div class="content">Detalle de proveedor</div>
    </h2>
    <br><br>
    <div class="field">
        <strong>Nit:</strong>
        {{ $proveedor->nit }}
    </div>
    <br>
    <div class="field">
        <strong>Nombre:</strong>
        {{ $proveedor->nombre }}
    </div>
    <br>
    <div class="field">
        <strong>Teléfono:</strong>
        {{ $proveedor->telefono }}
    </div>
    <br>
    <div class="field">
        <strong>Dirección:</strong>
        {{ $proveedor->direccion }}
    </div>
    <br>
    <div class="field">
        <strong>Forma de pago:</strong>
        {{ $proveedor->formaPago }}
    </div>
    <br>
    <div class="field">
        <strong>Descuento:</strong>
        {{ $proveedor->descuento }}
    </div>
    <br>
    <div class="field">
        <strong>Tiempo de entrega:</strong>
        {{ $proveedor->tiemposEntrega }}
    </div>
    <br>
    <div class="field">
        <strong>Devoluciones:</strong>
        {{ $proveedor->devoluciones }}
    </div>
    <br>
    
@endsection