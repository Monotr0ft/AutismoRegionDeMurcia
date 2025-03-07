<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autismo Región de Murcia - Login</title>
    @include('favicon.index')
    @include('bootstrap.css')
    <link rel="stylesheet" href="{{ asset('assets/css/autismologin.css') }}">
</head>
<body class="container-fluid d-flex flex-column justify-content-center">
    <div class="my-5 text-center d-flex flex-column justify-content-center align-items-center">
        <img src="{{ asset('assets/img/Murcia_-_Mapa_municipal.svg') }}" alt="Logo Autismo Región de Murcia" class="img-fluid" style="height: 200px;">
        <br>
        <h1>Autismo Región de Murcia - Cambiar Contraseña</h1>
        <br>
        @if ($errors->any())
            <h4 class="text-center p-4" style="background-color: #ab0000; border-radius: 10px; color: white;">{{ $errors->first() }}</h4>
        @endif
    </div>
    <div class="row">
        <div class="col-12 col-lg-4"></div>
        <form method="POST" action="{{ route('notyourself.update') }}" class="container col-12 col-lg-4 formulario">
            @csrf
            @method('PUT')
            <div class="my-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="my-3">
                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>
            <input type="hidden" name="token" value="{{ $token }}">
            <button type="submit" class="d-grid gap-2 col-6 mx-auto my-3 btn btn-dark login btn-lg">Cambiar Contraseña</button>
        </form>
        <div class="col-12 col-lg-4"></div>
    </div>
    @include('bootstrap.script')
</body>
</html>
