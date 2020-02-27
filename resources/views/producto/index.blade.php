@extends('layouts.layoutconfig')

@section('titulo', 'Productos')

@section('contenido')
    <h1 class="ui center aligned icon header">
        <i class="dolly icon"></i>
        <div class="content">
            Productos 
            <div class="sub header">
                Administre la información de sus productos.
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
    <table class="ui celled table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio Unit.</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
            <tr>
                <td>{{$producto->nombre}}</td>
                <td>{{$producto->cantidad}}</td>
                <td>{{$producto->precioUnitario}}</td>
                <td>
                    <a href="{{route('producto.show',$producto->id)}}" class="circular ui icon button grey"><i class="large icon eye white"></i></a>
                    <a href="{{route('producto.edit',$producto->id)}}" class="circular ui icon button blue"><i class="large icon edit white"></i></a>
                    <button onclick="estaSeguro({{$producto->id}})" class="circular ui icon button red"><i class="large icon trash inverted"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br><br>
    <a href="{{route('producto.create')}} ">
        <h2 class="ui header">
            <i class="plus circle icon"></i>
            <div class="content">
                Nuevo producto
                <div class="sub header">
                    Cree un nuevo producto
                </div>
            </div>
        </h2>
    </a>

    <script>
        $('.message .close')
            .on('click', function() {
                $(this)
                .closest('.message')
                .transition('fade');
            });
        function estaSeguro(id) {
            swal({
                title: "¿Está seguro de eliminar el producto?",
                text: "¡Una vez eliminado, no podrá deshacer la acción!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        var url = "{{route('borrarProducto', "id")}}";
                        var urlFinal = url.replace(/id/i, id);
                        location.href=urlFinal;
                    } else {
                        swal("No se ha eliminado el producto");
                    }
                });
        }
    </script>
@endsection