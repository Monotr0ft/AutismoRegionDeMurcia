<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 403</title>
    @include ('favicon.index')
    @include ('bootstrap.css')
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center my-5">
                <a href="{{ route('home') }}"><img src="{{ asset('assets/img/Murcia_-_Mapa_municipal.svg') }}" class="img-fluid" width="200" alt="Logo de Autismo Región de Murcia"></a>
                <h1>Aquí no hay nada que ver</h1>
            </div>
            <div class="col-12 text-center my-5">
                <h2>Error 403</h2>
                <p>No tienes permisos para entrar aquí.</p>
            </div>
        </div>
    </div>
    @include ('bootstrap.script')
</body>
</html>
