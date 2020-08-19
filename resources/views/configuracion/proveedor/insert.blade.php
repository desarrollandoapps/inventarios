@extends('layouts.layoutconfig')

@section('titulo', 'Nuevo Proveedor')

@section('contenido')
    <h2 class="ui header">
        <i class="icon plus circle"></i>
        <div class="content">Nuevo proveedor</div>
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
    <form class="ui form" method="POST" action="{{route('proveedor.store')}} ">
        @csrf
        <div class="field">
            <label>Nit:</label>
            <input type="text" name="nit" value="{{old('nit')}}"">
        </div>
        <div class="field">
            <label>Nombre:</label>
            <input type="text" name="nombre" value="{{old('nombre')}}"">
        </div>
        <div class="field">
            <label>Teléfono:</label>
            <input type="tel" name="telefono" value="{{old('telefono')}}">
        </div>
        <div class="field">
            <label>Direción:</label>
            <input type="text" name="direccion" value="{{old('direccion')}}">
        </div>
        <div class="field">
            <label>Forma de pago:</label>
            <input type="text" name="formaPago" value="{{old('formaPago')}}">
        </div>
        <div class="field">
            <label>Descuento:</label>
            <input type="text" name="descuento" value="{{old('descuento')}}">
        </div>
        <div class="field">
            <label>Tiempo de entrega:</label>
            <input type="text" name="tiemposEntrega" value="{{old('tiemposEntrega')}}">
        </div>
        <div class="field">
            <label>Devoluciones:</label>
            <input type="text" name="devoluciones" value="{{old('devoluciones')}}">
        </div>
        <button class="ui button primary" type="submit">Crear</button>
    </form>
    <script>
        $('#idCategoria').dropdown();
    </script>
@endsection