<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="{{asset('fontawesome/css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <link rel="stylesheet" href="{{asset('css/style(1).css')}}">

        <link rel="stylesheet" href="{{asset('css/unify-core.css')}}">
        <link rel="stylesheet" href="{{asset('css/unify-components.css')}}">
        <link rel="stylesheet" href="{{asset('css/unify-globals.css')}}">

        <link rel="stylesheet" href="{{asset('css/style(2).css')}}">

        @section('css')
        @show

        <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>

        @section('javascript')
        @show
    </head>
    <body>
        <nav class="navbar navbar-dark bg-dark fixed-top navbar-expand-lg shadow">
            <a class="navbar-brand" href="#">
                <img src="{{asset('images/logo-estatal-icon.svg')}}" width="30" height="30" class="d-inline-block align-top" alt="">
                Donación de Organos
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            @if(Auth::check())
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav w-100">
                        <li class="nav-item {{(isset($activo) && $activo == 'registro')?'active':''}}">
                            <a class="nav-link" href="registro">Formulario de Registro</a>
                        </li>
                        <li class="nav-item {{(isset($activo) && $activo == 'donadores')?'active':''}}">
                            <a class="nav-link" href="donadores">Listado de Donadores</a>
                        </li>
                    </ul>
                </div>
            
                <a class="btn btn-outline-info my-2 my-sm-0" href="logout"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
            @endif
        </nav>
        <br>
        <div class="container" style="padding-top:54px;">
            @section('content')
            @show
        </div>
        @if(Auth::check())
        <script type="text/javascript">
            function logout(){
                window.location.href = 'logout/';
            }
        </script>
        @endif
    </body>
</html>