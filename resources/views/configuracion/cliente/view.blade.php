@extends('layouts.layoutconfig')

@section('titulo', 'Detalle de cliente')

@section('contenido')
    <h2 class="ui header">
        <i class="icon eye"></i>
        <div class="content">Detalle de cliente</div>
    </h2>
    <br><br>
    <div class="field">
        <strong>Nit:</strong>
        {{ $cliente->nit }}
    </div>
    <br>
    <div class="field">
        <strong>Nombre:</strong>
        {{ $cliente->nombre }}
    </div>
    <br>
    <div class="field">
        <strong>Teléfono:</strong>
        {{ $cliente->telefono }}
    </div>
    <br>
    <div class="field">
        <strong>Dirección:</strong>
        {{ $cliente->direccion }}
    </div>
    <br>
    <div class="field">
        <strong>Forma de pago:</strong>
        {{ $cliente->formaPago }}
    </div>
    
@endsection