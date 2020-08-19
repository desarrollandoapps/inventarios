@extends('layouts.layoutconfig')

@section('titulo', 'Modificar Proveedor')

@section('contenido')
    <h2 class="ui header">
        <i class="icon plus circle"></i>
        <div class="content">Modificar proveedor</div>
    </h2>
    <br><br>
    @if ($errors->any())
        <div class="ui negative message">
            <i class="close icon"></i>
            <div class="header"><strong>Ups...</strong> Algo anda mal.</div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="ui form" method="POST" action="{{route('proveedor.update', $proveedor->id)}} ">
        @csrf
        @method('PUT')
        <div class="field">
            <label>Nit:</label>
            <input type="text" name="nit" value="{{$proveedor->nit}}"">
        </div>
        <div class="field">
            <label>Nombre:</label>
            <input type="text" name="nombre" value="{{$proveedor->nombre}}"">
        </div>
        <div class="field">
            <label>Teléfono:</label>
            <input type="tel" name="telefono" value="{{$proveedor->telefono}}">
        </div>
        <div class="field">
            <label>Direción:</label>
            <input type="text" name="direccion" value="{{$proveedor->direccion}}">
        </div>
        <div class="field">
            <label>Forma de pago:</label>
            <input type="text" name="formaPago" value="{{$proveedor->formaPago}}">
        </div>
        <div class="field">
            <label>Descuento:</label>
            <input type="text" name="descuento" value="{{$proveedor->descuento}}">
        </div>
        <div class="field">
            <label>Tiempo de entrega:</label>
            <input type="text" name="tiemposEntrega" value="{{$proveedor->tiemposEntrega}}">
        </div>
        <div class="field">
            <label>Devoluciones:</label>
            <input type="text" name="devoluciones" value="{{$proveedor->devoluciones}}">
        </div>
        <button class="ui button primary" type="submit">Modificar</button>
    </form>
@endsection