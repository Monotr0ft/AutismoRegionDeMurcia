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
    <div class="row">
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="col-md-3"></div>
            <div class="alert alert-danger alert-dismissible fade show col-md-6" role="alert">
                <strong>¡Error!</strong> {{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <div class="col-md-3"></div>
        @endforeach
    @endif
    @if (session('success'))
        <div class="col-md-3"></div>
        <div class="alert alert-success alert-dismissible fade show col-md-6" role="alert">
            <strong>¡Éxito!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="col-md-3"></div>
    @endif
    </div>
    @yield('content')
    @include('bootstrap.script')
</body>
</html
