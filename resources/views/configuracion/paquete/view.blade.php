@extends('layouts.layoutconfig')

@section('titulo', 'Detalle del paquete')

@section('contenido')
    <h2 class="ui header">
        <i class="icon eye"></i>
        <div class="content">Detalle del paquete</div>
    </h2>
    <br><br>
    <div class="ui two column grid">
        <div class="row">
            <div class="column">
                <strong>Producto:</strong>
                {{ $paquete[0]->nombreProducto }}
            </div>
            <div class="column">
                <strong>Presentación:</strong>
                {{ $paquete[0]->presentacion }}
            </div>
        </div>
        <div class="row">
            <div class="column">
                <strong>Unidades por paquete:</strong>
                {{ $paquete[0]->unidades }}
            </div>
        </div>
    </div>
    
@endsection