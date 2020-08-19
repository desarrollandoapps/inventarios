@extends('layouts.layoutconfig')

@section('titulo', 'Detalle de producto')

@section('contenido')
    <h2 class="ui header">
        <i class="icon eye"></i>
        <div class="content">Detalle de producto</div>
    </h2>
    <br><br>
    <div class="field">
        <strong>Categoría:</strong>
        {{ $producto->categoria }}
    </div>
    <br>
    <div class="field">
        <strong>Nombre:</strong>
        {{ $producto->nombre }}
    </div>
    <br>
    <div class="field">
        <strong>Cantidad:</strong>
        {{ $producto->cantidad }}
    </div>
    <br>
    <div class="field">
        <strong>Precio unitario:</strong>
        {{($producto->precioUnitario)}}
    </div>
@endsection