@extends('layouts.admin')

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

    <h3 class="mb-3">{{ __('Products') }}</h3>

    <button class="btn btn-primary" data-toggle="collapse" data-target="#collapseExample" 
        aria-expanded="false" aria-controls="collapseExample">Importar productos</button>
    <div class="collapse mt-2 mb-2" id="collapseExample">
        <form action=" {{route('producto.import.excel')}}" method="post" id="formAdd" enctype="multipart/form-data" class="hidden">
            @csrf
            <div class="input-group mb-3">
                <input type="file" name="file" id="file" class="form-control">
                <div class="input-group-append">
                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="asociar()">Importar</button>
                </div>
            </div>
        </form>
    </div>
    <table class="table mt-5">
        <thead>
            <tr>
                <th>Referencia</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $item)
                <tr>
                    <td> {{$item->referencia}}</td>
                    <td> {{$item->descripcion}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="float-right">
        {{ $productos->links() }}
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
    </script>
@endsection