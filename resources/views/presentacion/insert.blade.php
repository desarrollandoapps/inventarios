@extends('layouts.layoutconfig')

@section('titulo', 'Nueva presentación')

@section('contenido')
    <h2 class="ui header">
        <i class="icon plus circle"></i>
        <div class="content">Nueva presentación</div>
    </h2>
    <br><br>
    <form class="ui form" method="POST" action="{{route('presentacion.store')}} ">
        @csrf
        <div class="field">
            <label>Descripción:</label>
            <input type="text" name="descripcion" placeholder="Descripción">
        </div>
        <button class="ui button primary" type="submit">Crear</button>
      </form>
@endsection