@extends('layouts.layoutconfig')

@section('titulo', 'Clientes')
    
@section('contenido')
    <h1 class="ui center aligned icon header">
        <i class="address book icon"></i>
        <div class="content">
            Clientes 
            <div class="sub header">
                Administre la información de sus clientes.
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
            <a href="{{route('cliente.create')}}" class="hover">
                <h2 class="ui header">
                    <i class="plus circle icon"></i>
                    <div class="content">
                        Nuevo cliente
                        <div class="sub header">
                            Cree un nuevo cliente
                        </div>
                    </div>
                </h2>
            </a>
        </div>
    </div>
    <table class="ui celled table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Nit.</th>
                <th class="right aligned collapsing">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $item)
            <tr>
                <td>{{$item->nombre}}</td>
                <td>{{$item->nit}}</td>
                <td class="right aligned collapsing">
                    <a href="{{route('cliente.show',$item->id)}}" class="circular ui icon button grey"><i class="large icon eye white"></i></a>
                    <a href="{{route('cliente.edit',$item->id)}}" class="circular ui icon button blue"><i class="large icon edit white"></i></a>
                    <button onclick="estaSeguro({{$item->id}})" class="circular ui icon button red"><i class="large icon trash inverted"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">
                    <div class="ui right floated pagination menu">
                        <a class="icon item" href="{{$clientes->path() . '?page=1' }} ">
                            <i class="left chevron icon"></i>
                        </a>
                        @for($i = 1; $i <= $clientes->lastPage(); $i++)
                            <a class="item" href="{{$clientes->path() . '?page=' . $i }} ">{{$i}}</a>  
                        @endfor
                        <a class="icon item" href="{{$clientes->path() . '?page=' . $clientes->lastPage() }} ">
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
        function estaSeguro(id) {
            swal({
                title: "¿Está seguro de eliminar el cliente?",
                text: "¡Una vez eliminado, no podrá deshacer la acción!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        var url = "{{route('borrarCliente', "id")}}";
                        var urlFinal = url.replace(/id/i, id);
                        location.href=urlFinal;
                    } else {
                        swal("No se ha eliminado el cliente");
                    }
                });
        }
    </script>
@endsection