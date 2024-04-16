<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 404</title>
    @include ('bootstrap.css')
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center my-5">
                <img src="{{ asset('assets/img/Murcia_-_Mapa_municipal.svg') }}" class="img-fluid" width="200" alt="Logo de Autismo Región de Murcia">
                <h1>Aquí no hay nada que ver</h1>
            </div>
            <div class="col-12 text-center my-5">
                <h2>Error 404</h2>
                <p>La página que busca no existe. Por favor, vuelva a intentarlo más tarde.</p>
            </div>
        </div>
    </div>
    @include ('bootstrap.script')
</body>
</html>