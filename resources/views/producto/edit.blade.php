@extends('layouts.layoutconfig')

@section('titulo', 'Modificar producto')

@section('contenido')
    <h2 class="ui header">
        <i class="icon edit circle"></i>
        <div class="content">Modificar producto</div>
    </h2>
    <br><br>
    <form class="ui form" method="POST" action="{{route('producto.update', $producto->id)}} ">
        @csrf
        @method('PUT')
        <div class="field">
            <label>Nombre:</label>
            <input type="text" name="nombre" value="{{$producto->nombre}}">
        </div>
        <div class="field">
            <label>Cantidad:</label>
            <input type="number" name="cantidad" value="{{$producto->cantidad}}">
        </div>
        <div class="field">
            <label>Precio unitario:</label>
            <input type="number" name="precioUnitario" value="{{$producto->precioUnitario}}">
        </div>
        <button class="ui button primary" type="submit">Modificar</button>
      </form>
@endsection