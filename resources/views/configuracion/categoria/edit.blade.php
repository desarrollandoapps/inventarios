@extends('layouts.layoutconfig')

@section('titulo', 'Modificar categoría')

@section('contenido')
    <h2 class="ui header">
        <i class="icon edit circle"></i>
        <div class="content">Modificar categoría</div>
    </h2>
    <br><br>
    <form class="ui form" method="POST" action="{{route('categoria.update', $categoria->id)}} ">
        @csrf
        @method('PUT')
        <div class="field">
            <label>Nombre:</label>
            <input type="text" name="nombre" value="{{$categoria->nombre}}">
        </div>
        <button class="ui button primary" type="submit">Modificar</button>
      </form>
@endsection