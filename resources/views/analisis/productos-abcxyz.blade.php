@extends('layouts.admin')

@section('hidden-search')
    hidden
@endsection

@section('main-content')
    @if (Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{Session::get('mensaje')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{Session::get('error')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $item)
                    <li> {{$item}} </li>
                @endforeach
            </ul>    
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </div>
    @endif
    
    <div class="float-right mr-5">
        {{-- <a href="{{route('analisis.verRecomendaciones')}} " class="exportar-excel" data-toggle="tooltip" data-placement="left" title="Ver Recomendaciones">
            <i class="fas fa-fw fa-info-circle fa-2x"></i>
        </a> --}}
        <a class="exportar-excel" data-toggle="modal" data-target="#exampleModal" data-toggle="tooltip" data-placement="left" title="Ver Recomendaciones">
            <i class="fas fa-fw fa-info-circle fa-2x"></i>
        </a>
        <a href="{{route('full.export.excel')}} " class="exportar-excel" data-toggle="tooltip" data-placement="left" title="Exportar a Excel">
            <i class="fas fa-fw fa-file-excel fa-2x"></i>
        </a>
        <a href="{{route('abc.graficar')}} " class="generar-grafico" data-toggle="tooltip" data-placement="left" title="Generar gráfico">
            <i class="fas fa-fw fa-chart-bar fa-2x"></i>
        </a>
        
    </div>
  
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Recomendaciones</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Características</th>
                            <th>Modelo de inventarios</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Si el producto es tipo A o B y pertenece a un mismo proveedor de productos A y B</td>
                            <td>Revisión periódica multiproducto</td>
                        </tr>
                        <tr>
                            <td>Si el producto es A y no pertenece a un proveedor común</td>
                            <td>Revisión contínua del nivel de inventario</td>
                        </tr>
                        <tr>
                            <td>Si el producto es A y Z</td>
                            <td>Revisión contínua (Demanda no predecible)</td>
                        </tr>
                        <tr>
                            <td>Si el producto es C</td>
                            <td>Revisión periódica</td>
                        </tr>
                        <tr>
                            <td>Si el producto es B y no pertenece a un proveeedor común</td>
                            <td>Determinar un periodo de revisión y un nivel de inventario mínimo y máximo</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <a href="http://" target="_blank" rel="noopener noreferrer" class="generar-grafico">Descargar</a>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
            </div>
        </div>
        </div>
    </div>

    <h3 class="mb-3">{{ __('ABC - XYZ Classification') }}</h3>

    <h4 class="text-center">Año: {{$anio}}</h4>
    
    <table class="table table-hover mt-4">
        <thead class="thead-light">
            <tr>
                <th>Referencia</th>
                <th>Descripción</th>
                <th>ABC</th>
                <th>XYZ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($full as $item)
                <tr>
                    <td>{{$item->referencia}}</td>
                    <td>{{$item->descripcion}}</td>
                    <td>{{$item->tipoABC}}</td>
                    <td>{{$item->tipoXYZ}}</td>
                    {{-- <td>${{number_format($item->total, 0, ',', '.')}}</td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection

@section('scripts')
    <script>
        function asociar()
        {
            swal({
                title: "Procesando...",
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                html: '<i class="far fa-clock fa-7x"></i>',
            });
            $('#formAdd').submit();
        }
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                }, false);
                });
            }, false);
        })();
    </script>
@endsection