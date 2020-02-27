<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Site Properties -->
    <title>@yield('titulo')</title>

    <link rel="stylesheet" href="{{ asset('semantic/components/site.css') }}">
    <link rel="stylesheet" href="{{ asset('semantic/components/reset.css') }}">

    <link rel="stylesheet" href="{{ asset('semantic/components/container.css') }}">
    <link rel="stylesheet" href="{{ asset('semantic/components/grid.css') }}">
    <link rel="stylesheet" href="{{ asset('semantic/components/header.css') }}">
    <link rel="stylesheet" href="{{ asset('semantic/components/image.css') }}">
    <link rel="stylesheet" href="{{ asset('semantic/components/menu.css') }}">

    <link rel="stylesheet" href="{{ asset('semantic/components/divider.css') }}">
    <link rel="stylesheet" href="{{ asset('semantic/components/list.css') }}">
    <link rel="stylesheet" href="{{ asset('semantic/components/segment.css') }}">
    <link rel="stylesheet" href="{{ asset('semantic/components/dropdown.css') }}">
    <link rel="stylesheet" href="{{ asset('semantic/components/icon.css') }}">
    <link rel="stylesheet" href="{{ asset('semantic/components/button.css') }}">
    <link rel="stylesheet" href="{{ asset('semantic/components/table.css') }}">
    <link rel="stylesheet" href="{{ asset('semantic/components/form.css') }}">
    <link rel="stylesheet" href="{{ asset('semantic/components/message.css') }}">
    <link rel="stylesheet" href="{{ asset('semantic/components/transition.css') }}">
    <link rel="stylesheet" href="{{ asset('semantic/components/modal.css') }}">
    <link rel="stylesheet" href="{{ asset('semantic/components/step.css') }}">
    <link rel="stylesheet" href="{{ asset('semantic/components/rail.css') }}">
    <link rel="stylesheet" href="{{ asset('semantic/components/sticky.css') }}">
    <link rel="stylesheet" href="{{ asset('semantic/components/footer.css') }}">
    
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('semantic/components/dropdown.js')}} "></script>
    <script src="{{asset('semantic/components/transition.js')}} "></script>
    <script src="{{asset('semantic/components/modal.js')}} "></script>
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
    <div class="ui pointing menu">
        <a class="item" @yield('activo')>Home</a>
        <a class="item" @yield('activo')>Home</a>
        <a class="item" @yield('activo')>Home</a>
        <div class="right menu">
          <div class="item">
            <div class="ui transparent icon input">
              <input type="text" placeholder="Search...">
              <i class="search link icon"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="ui segment">
        <p></p>
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
    
</body>
</html>