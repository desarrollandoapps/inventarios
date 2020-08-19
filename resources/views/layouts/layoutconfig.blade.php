<!DOCTYPE html>
<html lang="es">
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <!-- Site Properties -->
  <title>@yield('titulo')</title>

  <link rel="stylesheet" href="{{ asset('semantic/semantic.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
  
  <script src="{{asset('js/jquery.min.js')}}"></script>
  <script src="{{asset('semantic/semantic.js')}} "></script>
  <script src="{{asset('js/sweetalert.min.js')}} "></script>

  <style type="text/css">
  body {
    background-color: #FFFFFF;
  }
  .ui.menu .item img.logo {
    margin-right: 1.5em;
  }
  .main.container {
    margin-top: 7em;
  }
  .wireframe {
    margin-top: 2em;
  }
  .ui.footer.segment {
    margin: 5em 0em 0em;
    padding: 5em 0em;
  }
  </style>

</head>
<body>

  <div class="ui fixed inverted menu">
    <div class="ui container">
      <a href="#" class="header item">
        <img class="logo" src="{{ asset('img/logo.jpg') }}">
        Project Name
      </a>
      <a href="{{route('home')}} " class="item">Inicio</a>
      <div class="ui simple dropdown item">
        Opciones <i class="dropdown icon"></i>
        <div class="menu">
          <a class="item" href="{{route('categoria.index')}} ">Categorías</a>
          <a class="item" href="{{route('producto.index')}} ">Productos</a>
          <a class="item" href="{{route('presentacion.index')}}">Presentaciones</a>
          <a class="item" href="{{route('paquete.index')}}">Paquetes</a>
          <div class="divider"></div>
          <a class="item" href="{{route('proveedor.index')}}">Proveedores</a>
          <a class="item" href="{{route('cliente.index')}}">Clientes</a>
        </div>
      </div>
    </div>
  </div>

  <div class="ui main container">
    @yield('contenido')
  </div>
  <br><br><br>
  <div class="footer-fixed">
    <div class="ui header inverted container">
      <div>
          <i class="plug icon inverted left floated"></i>
          <h3 class="ui right floated header inverted">
            &copy; GESICOM 2020
          </h3>
      </div>
    </div>
  </div>

  <script>
    @yield('scripts')
  </script>

</body>
</html>
