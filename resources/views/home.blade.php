@extends('layouts.admin')

@section('main-content')

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow mb-4">

                <div class="mt-4">
                    <img src="{{ asset('img/logo.png') }}" alt="logo-estiba" class="mx-auto d-block" height="100px">
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
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

@endsection
