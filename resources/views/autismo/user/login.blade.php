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
        <h1>Autismo Región de Murcia - Login</h1>
        @if ($errors->any())
            <h4 class="text-danger text-center p-4" style="background-color: whitesmoke; border-radius: 10px">{{ $errors->first() }}</h4>
        @endif
    </div>
    <div class="row">
        <div class="col-12 col-lg-4"></div>
        <form method="POST" action="{{ route('login') }}" class="container col-12 col-lg-4 formulario">
            @csrf
            <div class="my-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="my-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="d-grid gap-2 col-6 mx-auto my-3 btn btn-dark login btn-lg">Iniciar sesión</button>
        </form>
        <div class="col-12 col-lg-4"></div>
    </div>
    @include('bootstrap.script')
</body>
</html>
