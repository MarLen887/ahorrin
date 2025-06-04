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
</head>
<body>
    <!--inicia navbar-->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Cartera Inteligente</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/bancos">Bancos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="/operaciones">Operación</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!--fin-->
<!--inicia div principal-->
<div class="container-fluid">
    @yield('contenido')
</div>
<!--fin-->
</body>
<script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</html>