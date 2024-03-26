<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    @vite(['resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/sisad.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script src="{{ asset('js/apexcharts.js') }}"></script>
    <script src="{{ asset('js/fontawesome.min.js') }}"></script>
    @livewireStyles
</head>
<body class="dark" >
    <div id="app">
        @auth
        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top shadow-sm p-0 mx-2 border-3 border-bottom border-primary" style="border-radius: 0px 0px 25px 25px;">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('img/logo.png') }}" class="rounded-circle" alt="Logo" width="45px" height="45px">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link fw-bold active">
                                {{ __('Dashboard') }}
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" href="#" class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ __('Dispositivos') }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-start bg-dark rounded-0 rounded-bottom mt-2 border-2 border-start-0 border-end-0 border-primary border-bottom shadow-sm" aria-labelledby="navbarDropdown">
                                <a href="{{ route('dispositivos') }}" class="dropdown-item text-light">
                                    {{ __('Todos los dispositivos') }}
                                </a>
                                <div class="dropdown-divider bg-secondary"></div>
                                <a href="{{ route('dispositivos.favorito') }}" class="dropdown-item text-light">
                                    {{ __('Dispositivos favoritos') }}
                                </a>
                                <a href="{{ route('dispositivos.categoria') }}" class="dropdown-item text-light">
                                    {{ __('Dispositivos por categorías') }}
                                </a>
                                @if(@Auth::user()->hasRole('administrador'))
                                <div class="dropdown-divider bg-secondary"></div>
                                <a href="{{ route('dispositivos.create') }}" class="dropdown-item text-light">
                                    {{ __('Añadir dispositivo') }}
                                </a>
                                @endif
                            </div>
                        </li>
                        @if(@Auth::user()->hasRole('administrador'))
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" href="#" class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ __('Plantillas') }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-start bg-dark rounded-0 rounded-bottom mt-2 border-2 border-start-0 border-end-0 border-primary border-bottom shadow-sm" aria-labelledby="navbarDropdown">
                                <a href="{{ route('plantillas') }}" class="dropdown-item text-light">
                                    {{ __('Todas las plantillas') }}
                                </a>
                                <div class="dropdown-divider bg-secondary"></div>
                                <a href="{{ route('plantillas', 'create') }}" class="dropdown-item text-light">
                                    {{ __('Añadir plantilla') }}
                                </a>
                            </div>
                        </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" href="#" class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ __('Alarmas') }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-start bg-dark rounded-0 rounded-bottom mt-2 border-2 border-start-0 border-end-0 border-primary border-bottom shadow-sm" aria-labelledby="navbarDropdown">
                                <a href="{{ route('alarmas') }}" class="dropdown-item text-light">
                                    {{ __('Todas las alarmas') }}
                                </a>
                                <div class="dropdown-divider bg-secondary"></div>
                                <a href="{{ route('alarmas.dispositivo') }}" class="dropdown-item text-light">
                                    {{ __('Alarmas por dispositivos') }}
                                </a>
                                <div class="dropdown-divider bg-secondary"></div>
                                <a href="{{ route('alarmas.satisfactorio') }}" class="dropdown-item text-light">
                                    {{ __('Satisfactorias') }}
                                </a>
                                <a href="{{ route('alarmas.advertencia') }}" class="dropdown-item text-light">
                                    {{ __('Advertencias') }}
                                </a>
                                <a href="{{ route('alarmas.error') }}" class="dropdown-item text-light">
                                    {{ __('Errores') }}
                                </a>
                            </div>
                        </li>
                        @if(@Auth::user()->hasRole('administrador'))
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" href="#" class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ __('Sistema') }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-start bg-dark rounded-0 rounded-bottom mt-2 border-2 border-start-0 border-end-0 border-primary border-bottom shadow-sm" aria-labelledby="navbarDropdown">
                                <a href="{{ route('sistema.iniciar') }}" class="dropdown-item text-light">
                                    {{ __('Iniciar servicios') }}
                                </a>
                                <a href="{{ route('sistema.detener') }}" class="dropdown-item text-light">
                                    {{ __('Detener servicios') }}
                                </a>
                                <div class="dropdown-divider bg-secondary"></div>
                                <a href="{{ route('sistema.logs') }}" class="dropdown-item text-light">
                                    {{ __('Logs del sistema') }}
                                </a>
                            </div>
                        </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" href="#" class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ __('Anotaciones') }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-start bg-dark rounded-0 rounded-bottom mt-2 border-2 border-start-0 border-end-0 border-primary border-bottom shadow-sm" aria-labelledby="navbarDropdown">
                                <a href="{{ route('nota.index') }}" class="dropdown-item text-light">
                                    {{ __('Ver Anotaciones') }}
                                </a>
                                <a href="#" class="dropdown-item text-light" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    {{ __('Nueva Anotación') }}
                                </a>
                            </div>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                @livewire('app.alarma-status')
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end bg-dark rounded-0 rounded-bottom mt-2 border-2 border-start-0 border-end-0 border-primary border-bottom shadow-sm" aria-labelledby="navbarDropdown">
                                    <div class="h7 mx-3 mb-2 text-secondary">{{ __("Administrar cuenta") }}</div>
                                    <a class="dropdown-item text-light" href="{{ route('usuario.perfil', Auth::user()->id) }}">
                                        {{ __('Perfil') }}
                                    </a>
                                    @if(@Auth::user()->hasRole('administrador') && @Auth::user()->name=='Administrador')
                                        <div class="dropdown-divider bg-secondary"></div>
                                        <a class="dropdown-item text-light" href="{{ route('usuario.create') }}">
                                            {{ __('Nuevo usuario') }}
                                        </a>
                                        <a class="dropdown-item text-light" href="{{ route('usuario.index') }}">
                                            {{ __('Lista de usuarios') }}
                                        </a>
                                    @endif
                                    <div class="dropdown-divider bg-secondary"></div>
                                    <button type="button" class="dropdown-item text-light" data-bs-toggle="modal" data-bs-target="#salirSistema">
                                        {{ __('Logout') }}
                                    </button>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <nav aria-label="breadcrumb shadow-sm" style="margin-top: 4rem;">
            @yield('breadcrumb')
        </nav>

        <div class="modal fade" id="salirSistema" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content bg-dark shadow">
                    <div class="modal-header bg-danger text-white fw-bold">
                        <h5 class="modal-title"><i class="fa fa-arrow-right fa-lg me-3"></i> Salir del Sistema</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <div class="modal-body text-white">
                            Esta seguro que quiere salir del sistema?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endauth

        <main style="margin-bottom:30px;">
            @yield('content')
        </main>

        @auth
            @livewire('notas.create');

            <footer class="py-2 bg-dark shadow-sm fixed-bottom mx-2" style="border-radius: 25px 25px 0px 0px;">
                <div class="text-light text-center">Sistema de Adquisición de Datos - Copyright 2022</div>
            </footer>
        @endauth
    </div>

    @livewireScripts
    @yield('scripts')
    <script>
        window.addEventListener('alert', event => {
            toastr[event.detail.type](event.detail.message,
            event.detail.title ?? ''), toastr.options = {
                "closeButton": true,
                "progressBar": true,
            }
        });
    </script>
</body>
</html>
