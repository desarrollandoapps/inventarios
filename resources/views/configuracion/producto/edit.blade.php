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
            <label>Categoría:</label>
            <div class="ui fluid search selection dropdown" id="idCategoria">
                <input type="hidden" name="idCategoria">
                <i class="dropdown icon"></i>
                <div class="default text">Seleccione un Producto...</div>
                <div class="menu">
                    @foreach ($categorias as $item)
                    <div class="item" data-value="{{ $item->id }}">{{ $item->nombre }}</div>
                @endforeach
                </div>
            </div>
        </div>
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
    <script>
        $('#idCategoria').dropdown('set selected', '{{$producto->idCategoria}}');
    </script>
@endsection