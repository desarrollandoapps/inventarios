@extends('layouts.layoutconfig')

@section('titulo', 'Modificar cliente')

@section('contenido')
    <h2 class="ui header">
        <i class="icon plus circle"></i>
        <div class="content">Modificar cliente</div>
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
    <form class="ui form" method="POST" action="{{route('cliente.update', $cliente->id)}} ">
        @csrf
        @method('PUT')
        <div class="field">
            <label>Nit:</label>
            <input type="text" name="nit" value="{{$cliente->nit}}"">
        </div>
        <div class="field">
            <label>Nombre:</label>
            <input type="text" name="nombre" value="{{$cliente->nombre}}"">
        </div>
        <div class="field">
            <label>Teléfono:</label>
            <input type="tel" name="telefono" value="{{$cliente->telefono}}">
        </div>
        <div class="field">
            <label>Direción:</label>
            <input type="text" name="direccion" value="{{$cliente->direccion}}">
        </div>
        <div class="field">
            <label>Forma de pago:</label>
            <input type="text" name="formaPago" value="{{$cliente->formaPago}}">
        </div>
        <button class="ui button primary" type="submit">Modificar</button>
    </form>
@endsection