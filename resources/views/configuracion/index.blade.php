@extends('layouts.layoutconfig')

@section('titulo', 'Configuración')

@section('contenido')
    <h1 class="ui center aligned icon header">
        <i class="settings icon"></i>
        <div class="content">
            Configuración
            <div class="sub header">
                Administre la configuración del proyecto.
            </div>
            <br><br><br>
            <div class="ui three column grid">
                <div class="row">
                    <div class="column">
                        <a href="{{route('productoIndex')}}">
                            <h2 class="ui center aligned icon sub header">
                                <i class="circular dolly icon"></i>
                                Productos
                            </h2>
                        </a>
                    </div>
                    <div class="column">
                        <a href="{{route('presentacionIndex')}}">
                            <h2 class="ui center aligned icon sub header">
                                <i class="circular tags icon"></i>
                                Presentaciones
                            </h2>
                        </a>
                    </div>
                    <div class="column">
                        <a href="{{route('paqueteIndex')}}">
                            <h2 class="ui center aligned icon sub header">
                                <i class="circular boxes icon"></i>
                                Paquetes
                            </h2>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </h1>
    
@endsection
