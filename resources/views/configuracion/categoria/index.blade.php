@extends('layouts.layoutconfig')

@section('titulo', 'Categorías')

@section('contenido')
    <h1 class="ui center aligned icon header">
        <i class="sitemap icon"></i>
        <div class="content">
            Categorías 
            <div class="sub header">
                Administre la información delas categorías en que se agrupan sus productos.
            </div>
        </div>
    </h1>
    @if ($mensaje = Session::get('exito'))
        <br><br>
        <div class="ui positive message">
            <i class="close icon"></i>
            <div class="header">Registro exitoso</div>
            <p>{{$mensaje}}</p>
        </div>
    @endif
    @if ($mensaje = Session::get('fallo'))
        <br><br>
        <div class="ui negative message">
            <i class="close icon"></i>
            <div class="header">Error</div>
            <p>{{$mensaje}}</p>
        </div>
    @endif
    <br><br>
    <div class="ui right aligned grid">
        <div class="right floated left aligned four wide column">
            <a href="{{route('categoria.create')}}">
                <h2 class="ui header hover">
                    <i class="plus circle icon"></i>
                    <div class="content">
                        Nueva categoría
                        <div class="sub header">
                            Cree una nueva categoría
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
                <th class="right aligned collapsing">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $item)
            <tr>
                <td>{{$item->nombre}}</td>
                <td class="right aligned collapsing">
                    <a href="{{route('categoria.show',$item->id)}}" class="circular ui icon button grey"><i class="large icon eye white"></i></a>
                    <a href="{{route('categoria.edit',$item->id)}}" class="circular ui icon button blue"><i class="large icon edit white"></i></a>
                    <button onclick="estaSeguro({{$item->id}})" class="circular ui icon button red"><i class="large icon trash inverted"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4">
                    <div class="ui right floated pagination menu">
                        <a class="icon item" href="{{$categorias->path() . '?page=1' }} ">
                            <i class="left chevron icon"></i>
                        </a>
                        @for($i = 1; $i <= $categorias->lastPage(); $i++)
                            <a class="item" href="{{$categorias->path() . '?page=' . $i }} ">{{$i}}</a>  
                        @endfor
                        <a class="icon item" href="{{$categorias->path() . '?page=' . $categorias->lastPage() }} ">
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
                title: "¿Está seguro de eliminar la categoría?",
                text: "¡Una vez eliminado, no podrá deshacer la acción!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        var url = "{{route('borrarCategoria', "id")}}";
                        var urlFinal = url.replace(/id/i, id);
                        location.href=urlFinal;
                    } else {
                        swal("No se ha eliminado la categoria");
                    }
                });
        }
    </script>
@endsection