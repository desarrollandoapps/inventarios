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
            <label>Categoría:</label>
            <div class="ui fluid search selection dropdown" id="idCategoria">
                <input type="hidden" name="idCategoria" value="{{old('idCategoria')}}">
                <i class="dropdown icon"></i>
                <div class="default text">Seleccione una categoría...</div>
                <div class="menu">
                    @foreach ($categorias as $item)
                        <div class="item" data-value="{{ $item->id }}">{{ $item->nombre }}</div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="field">
            <label>Nombre:</label>
            <input type="text" name="nombre" placeholder="Nombre" value="{{old('nombre')}}"">
        </div>
        <div class="field">
            <label>Cantidad:</label>
            <input type="number" name="cantidad" placeholder="0" value="{{old('cantidad')}}">
        </div>
        <div class="field">
            <label>Precio unitario:</label>
            <input type="number" name="precioUnitario" placeholder="0" value="{{old('precioUnitario')}}">
        </div>
        <button class="ui button primary" type="submit">Crear</button>
    </form>
    <script>
        $('#idCategoria').dropdown();
    </script>
@endsection