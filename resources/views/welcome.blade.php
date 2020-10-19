<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Jose Oviedo">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Estiba') }}</title>

    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon" type="image/png">
</head>
<body>

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow mb-4">

                <div class="mt-4">
                    <img src="{{ asset('img/logo.png') }}" alt="logo-estiba" class="mx-auto d-block">
                </div>

                <div class="card-profile-image mt-4">
                    <img src="{{ asset('img/logo_sena.png') }}" alt="logo-sena" class="logo-sena">
                    <img src="{{ asset('img/logo_sennova.png') }}" alt="logo-sennova">
                    <img src="{{ asset('img/logo_gesicom.png') }}" alt="logo-gesicom">
                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-12 mb-1">
                            <div class="text-center">
                                <h3 class="font-weight-bold">Servicio Nacional de Aprendizaje SENA</h3>
                                <h4 class="font-weight-bold">Regional Tolima</h4>
                                <h4 class="font-weight-bold">Centro de Comercio y Servicios</h4>
                                <h5 class="font-weight-bold">Grupo de investigación GESICOM</h5>
                                <h5 class="font-weight-bold">Desarrollado por Jose Alonso Oviedo Monroy</h5>
                                <h6 class="font-weight-bold">2020</h6>
                                <a href="{{route('home')}}" class="btn btn-primary btn-sm">Ingresar</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</body>
</html>