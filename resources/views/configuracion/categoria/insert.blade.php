@extends('layouts.layoutconfig')

@section('titulo', 'Nueva categoría')

@section('contenido')
    <h2 class="ui header">
        <i class="icon plus circle"></i>
        <div class="content">Nueva categoría</div>
    </h2>
    <br><br>
    @if ($errors->any())
        <div class="ui negative message">
            <i class="close icon"></i>
            <div class="header"><strong>Ups...</strong> Algo anda mal.</div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="ui form" method="POST" action="{{route('categoria.store')}} ">
        @csrf
        <div class="field">
            <label>Nombre:</label>
            <input type="text" name="nombre" placeholder="Nombre">
        </div>
        <button class="ui primary submit button" type="submit">Crear</button>
    </form>
@endsection