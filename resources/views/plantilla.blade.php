<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cartera Inteligente</title>

    {{-- Carga de CSS --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css')}} "> {{-- Font Awesome para iconos --}}
    <link rel="stylesheet" href="{{ asset('css/personalizacion.css')}} ">

    {{-- Opcional: CSS de SweetAlert2 si lo usas para las alertas --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        /* Estilos generales que no estén en personalizacion.css o Bootstrap */
        body {
            font-family: 'Nunito', sans-serif; /* Si usas Nunito u otra fuente */
        }
        .seccion-principal {
            padding: 20px;
            min-height: calc(100vh - 56px); /* Ajusta si tienes un navbar fijo para que ocupe el resto de la pantalla */
        }
        /* Estilos personalizados para botones (si no están en personalizacion.css) */
        .btn-color-custom-darkblue {
            background-color: #0B2C79; /* Un azul oscuro */
            color: #fff;
        }
        .btn-color-custom-darkblue:hover {
            background-color: #082260; /* Un azul más oscuro para hover */
            color: #fff;
        }
        .btn-color-custom-cerulean {
            background-color: #2A61AE; /* Un azul cerúleo */
            color: #fff;
        }
        .btn-color-custom-cerulean:hover {
            background-color: #204b8a; /* Un azul más oscuro para hover */
            color: #fff;
        }
        /* Estilos para la tabla */
        .tabla-estilizada thead {
            background-color: #e9ecef; /* Un gris claro para el encabezado */
            color: #495057;
        }
        .tabla-estilizada th, .tabla-estilizada td {
            vertical-align: middle;
        }
        /* Eliminar estilos del dashboard de aquí, ya que irán en personalizacion.css */
        /*
        .dashboard-container { ... }
        .header-dashboard { ... }
        ... etc.
        */
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Cartera Inteligente</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        {{-- Nuevo enlace para el Dashboard (Inicio) --}}
                        <a class="nav-link @if(Request::is('/') || Request::is('dashboard')) active @endif" aria-current="page" href="{{ route('dashboard.index') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        {{-- El enlace para Bancos --}}
                        <a class="nav-link @if(Request::is('bancos') || Request::is('bancos/*')) active @endif" href="{{ route('bancos.index') }}">Bancos</a>
                    </li>
                    <li class="nav-item">
                        {{-- El enlace para Categorías --}}
                        <a class="nav-link @if(Request::is('categorias') || Request::is('categorias/*')) active @endif" href="{{ route('categorias.index') }}">Categorías</a>
                    </li>
                    <li class="nav-item">
                        {{-- El enlace para Operaciones --}}
                        <a class="nav-link @if(Request::is('operaciones') || Request::is('operaciones/*')) active @endif" href="{{ url('/operaciones') }}">Operación</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        @yield('contenido')
    </div>
    {{-- IMPORTANTE: Scripts de JavaScript al final del body --}}
    {{-- Carga de librerías JS primero --}}
    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    {{-- Carga de SweetAlert2 JS si lo usas para las alertas --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Aquí se inyectarán los scripts específicos de cada vista (como bancos.blade.php) --}}
    @yield('scripts')
</body>
</html>