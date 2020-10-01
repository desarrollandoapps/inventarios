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
    
    <h3 class="mb-3">{{ __('Full Classification') }}</h3>

    <div class="row justify-content-md-center">
        <form action="{{route('analisis.clasificacionABCXYZ')}}" id="formAdd" method="post" 
            enctype="multipart/form-data" class="needs-validation" novalidate>
            @csrf
            <div class="form-row">
                <div class="col">
                    <label for="anio">Año</label>
                    <select name="anio" id="anio" class="custom-select d-inline-block" required>
                        <option value="">Seleccione el año...</option>
                        @foreach ($anios as $anio)
                            <option value="{{$anio}}">{{$anio}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="form-row mt-3">
                <button type="submit" class="btn btn-outline-primary mx-auto" onclick="asociar()">Analizar</button>
            </div>
        </form>
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
                html: '<img src="{{asset('img/loading.gif')}} " alt="cargando" width="100px">',
                // imageUrl: "{{asset('img/cargando.gif')}}",
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