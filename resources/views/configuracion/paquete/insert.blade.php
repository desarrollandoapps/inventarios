@extends('layouts.layoutconfig')

@section('titulo', 'Nuevo paquete')

@section('contenido')
    <h2 class="ui header">
        <i class="icon plus circle"></i>
        <div class="content">Nuevo paquete</div>
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
    <form class="ui form" method="POST" action="{{route('paquete.store')}} ">
        @csrf
        <div class="field">
            <label>Producto:</label>
            <div class="ui fluid search selection dropdown" id="dropProducto">
                <input type="hidden" name="idProducto">
                <i class="dropdown icon"></i>
                <div class="default text">Seleccione un Producto...</div>
                <div class="menu">
                    @foreach ($productos as $producto)
                        <div class="item" data-value="{{ $producto->id }}">{{ $producto->nombre }}</div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="field">
            <label>Presentación:</label>
            <div class="ui fluid search selection dropdown" id="dropPresentacion">
                <input type="hidden" name="idPresentacion">
                <i class="dropdown icon"></i>
                <div class="default text">Seleccione un Presentación...</div>
                <div class="menu">
                    @foreach ($presentaciones as $presentacion)
                    <div class="item" data-value="{{ $presentacion->id }}">{{ $presentacion->descripcion }}</div>
                @endforeach
                </div>
            </div>
        </div>
        <div class="field">
            <label>Cantidad de productos en el paquete:</label>
            <input type="number" name="unidades" placeholder="0">
        </div>
        <button class="ui button primary" type="submit">Crear</button>
      </form>
      <script>
          $('#dropProducto').dropdown();
          $('#dropPresentacion').dropdown();
      </script>
@endsection