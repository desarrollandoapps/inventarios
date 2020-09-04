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

    <h3 class="mb-3">{{ __('Sales') }}</h3>

    <button class="btn btn-primary" data-toggle="collapse" data-target="#collapseExample" 
        aria-expanded="false" aria-controls="collapseExample">Importar Venta</button>
    <div class="collapse mt-2 mb-2" id="collapseExample">
        <form action="{{route('venta.insert')}}" id="formAdd" method="post" 
            enctype="multipart/form-data" class="hidden needs-validation" novalidate>
            @csrf
            <div class="form-row">
                <div class="col-md-4">
                    <label for="anio">Año</label>
                    <select name="anio" id="anio" class="custom-select d-inline-block" required>
                        <option value="">Seleccione el año...</option>
                        @foreach ($anios as $anio)
                            <option value="{{$anio}}">{{$anio}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="totalCajas">Total cajas</label>
                    <input type="number" name="totalCajas" id="totalCajas" min="1" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="valorTotal">Valor total</label>
                    <input type="number" name="valorTotal" id="totalCajas" min="1" class="form-control" required>
                </div>
            </div>
            <div class="form-row">
                <div class="input-group mb-3 mt-3">
                    <input type="file" name="file" id="file" class="form-control" required>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-secondary btn-sm">Importar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Año</th>
                        <th>Total Cajas</th>
                        <th>Valor Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ventas as $item)
                        <tr>
                            <td> {{$item->id}}</td>
                            <td> {{$item->anio}}</td>
                            <td> {{number_format($item->totalCajas, 0, ',', '.')}}</td>
                            <td class="text-right"> ${{number_format($item->valorTotal, 0, ',', '.')}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right">
                {{ $ventas->links() }}
            </div>
        </div>
    </div>

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