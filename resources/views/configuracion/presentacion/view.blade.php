@extends('layouts.layoutconfig')

@section('titulo', 'Detalle de presentación')

@section('contenido')
    <h2 class="ui header">
        <i class="icon eye"></i>
        <div class="content">Detalle de presentación</div>
    </h2>
    <br><br>
    <div class="field">
        <strong>Descripción:</strong>
        {{ $presentacion->descripcion }}
    </div>
@endsection