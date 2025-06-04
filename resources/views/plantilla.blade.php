<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cartera Inteligente</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css')}} ">
    <link rel="stylesheet" href="{{ asset('css/personalizacion.css')}} ">

    {{-- Opcional: Si estás usando SweetAlert2, también deberías considerar su CSS aquí --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css"> --}}

    {{-- Puedes añadir tus estilos CSS personalizados aquí o en personalizacion.css --}}
    <style>
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
        .seccion-principal {
            padding: 20px;
        }
        .tabla-estilizada thead {
            background-color: #e9ecef;
            color: #495057;
        }
        .tabla-estilizada th, .tabla-estilizada td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Cartera Inteligente</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link @if(Request::is('bancos') || Request::is('bancos/*')) active @endif" aria-current="page" href="{{ route('bancos.index') }}">Bancos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(Request::is('operaciones') || Request::is('operaciones/*')) active @endif" href="{{ url('/operaciones') }}">Operación</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        @yield('contenido')
    </div>
    {{-- ¡AQUÍ ESTÁ LA SOLUCIÓN! --}}
    {{-- Carga de Bootstrap JS --}}
    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    {{-- Carga de SweetAlert2 JS si lo usas --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- ¡MUY IMPORTANTE! Aquí se inyectarán los scripts de las vistas individuales como bancos.blade.php --}}
    @yield('scripts')

</body>
</html>