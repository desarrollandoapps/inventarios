@extends('layouts.layoutconfig')

@section('titulo', 'Modificar presentación')

@section('contenido')
    <h2 class="ui header">
        <i class="icon plus circle"></i>
        <div class="content">Modificar presentación</div>
    </h2>
    <br><br>
    <form class="ui form" method="POST" action="{{route('presentacion.update', $presentacion->id)}} ">
        @csrf
        @method('PUT')
        <div class="field">
            <label>Descripción:</label>
            <input type="text" name="descripcion" placeholder="Descripción" value="{{$presentacion->descripcion}}">
        </div>
        <button class="ui button primary" type="submit">Modificar</button>
      </form>
@endsection