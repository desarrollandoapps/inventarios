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
            <br>
            <div class="ui four column grid padded grid">
                <div class="row">
                    <div class="column">
                        <a href="{{route('categoria.index')}}">
                            <h2 class="ui center aligned icon sub header">
                                <i class="circular sitemap icon"></i>
                                Categorías
                            </h2>
                        </a>
                    </div>
                    <div class="column">
                        <a href="{{route('producto.index')}}">
                            <h2 class="ui center aligned icon sub header">
                                <i class="circular dolly icon"></i>
                                Productos
                            </h2>
                        </a>
                    </div>
                    <div class="column">
                        <a href="{{route('presentacion.index')}}">
                            <h2 class="ui center aligned icon sub header">
                                <i class="circular tags icon"></i>
                                Presentaciones
                            </h2>
                        </a>
                    </div>
                    <div class="column">
                        <a href="{{route('paquete.index')}}">
                            <h2 class="ui center aligned icon sub header">
                                <i class="circular boxes icon"></i>
                                Paquetes
                            </h2>
                        </a>
                    </div>
                </div>
            </div>
            <div class="ui two column grid padded grid">
                <div class="row">
                    <div class="column">
                        <a href="{{route('proveedor.index')}}">
                            <h2 class="ui center aligned icon sub header">
                                <i class="circular truck icon"></i>
                                Proveedores
                            </h2>
                        </a>
                    </div>
                    <div class="column">
                        <a href="{{route('cliente.index')}}">
                            <h2 class="ui center aligned icon sub header">
                                <i class="circular address book icon"></i>
                                Clientes
                            </h2>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </h1>
    
@endsection
