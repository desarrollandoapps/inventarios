@extends('layouts.layoutconfig')

@section('titulo', 'Nuevo producto')

@section('contenido')
    <h2 class="ui header">
        <i class="icon plus circle"></i>
        <div class="content">Nuevo producto</div>
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
    <form class="ui form" method="POST" action="{{route('producto.store')}} ">
        @csrf
        <div class="field">
            <label>Nombre:</label>
            <input type="text" name="nombre" placeholder="Nombre">
        </div>
        <div class="field">
            <label>Cantidad:</label>
            <input type="number" name="cantidad" placeholder="0">
        </div>
        <div class="field">
            <label>Precio unitario:</label>
            <input type="number" name="precioUnitario" placeholder="0">
        </div>
        <button class="ui button primary" type="submit">Crear</button>
    </form>
@endsection