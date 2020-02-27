@extends('layouts.layoutconfig')

@section('titulo', 'Proveedores')
    
@section('contenido')
    <h1 class="ui center aligned icon header">
        <i class="dolly icon"></i>
        <div class="content">
            Productos 
            <div class="sub header">
                Administre la información de sus proveedores.
            </div>
        </div>
    </h1>
    <br><br>
    @if ($mensaje = Session::get('exito'))
        <div class="ui positive message">
            <i class="close icon"></i>
            <div class="header">Registro exitoso</div>
            <p>{{$mensaje}}</p>
        </div>
    @endif
    @if ($mensaje = Session::get('fallo'))
        <div class="ui negative message">
            <i class="close icon"></i>
            <div class="header">Error</div>
            <p>{{$mensaje}}</p>
        </div>
    @endif
@endsection