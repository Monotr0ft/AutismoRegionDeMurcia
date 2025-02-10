<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')
    @include('favicon.index')
    @include('bootstrap.css')
    @include('jquery.script')
</head>
<body class="container-fluid">
    @include('autismo.dashboard.componentes.navbar')
    @yield('content')
    @include('bootstrap.script')
</body>
</html
