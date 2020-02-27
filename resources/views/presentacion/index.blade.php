@extends('layouts.layoutconfig')

@section('titulo', 'Presentaciones')
    
@section('contenido')
    <h1 class="ui center aligned icon header">
        <i class="tags icon"></i>
        <div class="content">
            Presentaciones 
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
    <table class="ui celled table">
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($presentaciones as $presentacion)
                <tr>
                    <td>{{$presentacion->descripcion}} </td>  
                    <td>
                        <a href="{{route('presentacion.show',$presentacion->id)}}" class="circular ui icon button grey"><i class="large icon eye white"></i></a>
                        <a href="{{route('presentacion.edit',$presentacion->id)}}" class="circular ui icon button blue"><i class="large icon edit white"></i></a>
                        <button onclick="estaSeguro({{$presentacion->id}})" class="circular ui icon button red"><i class="large icon trash inverted"></i></button>
                    </td>
                </tr>
              @endforeach
        </tbody>
    </table>
    <br><br>
    <a href="{{route('presentacion.create')}} ">
        <h2 class="ui header">
            <i class="plus circle icon"></i>
            <div class="content">
                Nueva presentación
                <div class="sub header">
                    Cree una nueva presentación
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
            title: "¿Está seguro de eliminar la presentación?",
            text: "¡Una vez eliminado, no podrá deshacer la acción!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var url = "{{route('borrarPresentacion', "id")}}";
                    var urlFinal = url.replace(/id/i, id);
                    location.href=urlFinal;
                } else {
                    swal("No se ha eliminado la presentación");
                }
            });
        }
    </script>
@endsection