@extends('layouts.layoutconfig')

@section('titulo', 'Detalle de categoría')

@section('contenido')
    <h2 class="ui header">
        <i class="icon eye"></i>
        <div class="content">Detalle de categoría</div>
    </h2>
    <br><br>
    <div class="field">
        <strong>Nombre:</strong>
        {{ $categoria->nombre }}
    </div>
@endsection