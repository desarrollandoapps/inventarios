@extends('layouts.layoutconfig')

@section('titulo', 'Paquetes')
    
@section('contenido')
    <h1 class="ui center aligned icon header">
        <i class="boxes icon"></i>
        <div class="content">
            Paquetes 
            <div class="sub header">
                Administre las presentaciones de sus productos.
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
    <div class="ui right aligned grid">
        <div class="right floated left aligned four wide column">
            <a href="{{route('paquete.create')}} ">
                <h2 class="ui header">
                    <i class="plus circle icon"></i>
                    <div class="content">
                        Nuevo paquete
                        <div class="sub header">
                            Cree un nuevo paquete
                        </div>
                    </div>
                </h2>
            </a>
        </div>
    </div>
    <table class="ui celled table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Presentación</th>
                <th>Unidades</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paquetes as $paquete)
                <tr>
                    <td>{{$paquete->nombreProducto}} </td>  
                    <td>{{$paquete->presentacion}} </td>  
                    <td>{{$paquete->unidades}} </td>  
                    <td>
                        <a href="{{ url('paquete/show', ['idProducto' => $paquete->idProducto, 'idPresentacion' => $paquete->idPresentacion]) }}" class="circular ui icon button grey"><i class="large icon eye inverted"></i></a>
                        <button onclick="estaSeguro({{$paquete->idProducto}}, {{$paquete->idPresentacion}})" class="circular ui icon button red"><i class="large icon trash inverted"></i></button>
                    </td>
                </tr>
              @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4">
                    <div class="ui right floated pagination menu">
                        <a class="icon item" href="{{$paquetes->path() . '?page=1' }} ">
                            <i class="left chevron icon"></i>
                        </a>
                        @for($i = 1; $i <= $paquetes->lastPage(); $i++)
                            <a class="item" href="{{$paquetes->path() . '?page=' . $i }} ">{{$i}}</a>  
                        @endfor
                        <a class="icon item" href="{{$paquetes->path() . '?page=' . $paquetes->lastPage() }} ">
                            <i class="right chevron icon"></i>
                        </a>
                    </div>    
                </th>
            </tr>
        </tfoot>
    </table>
    
    <script>
        $('.message .close')
            .on('click', function() {
                $(this)
                .closest('.message')
                .transition('fade');
            });
        function estaSeguro(idProducto, idPresentacion) {
            swal({
                title: "¿Está seguro de eliminar el paquete?",
                text: "¡Una vez eliminado, no podrá deshacer la acción!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        var url = "{{ route('borrarPaquete', ['idProducto' => "idProducto", 'idPresentacion' => "idPresentacion"])}}";
                        var urlFinal1 = url.replace(/idProducto/i, idProducto);
                        var urlFinal2 = urlFinal1.replace(/idPresentacion/i, idPresentacion);
                        location.href=urlFinal2;
                    } else {
                        swal("No se ha eliminado el paquete");
                    }
                });
            }
    </script>
@endsection