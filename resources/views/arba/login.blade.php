<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARBA Inicio de Sesión</title>
    @include('bootstrap.index')
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
</head>
<body class="container-fluid d-flex flex-column justify-content-center align-items-center">
    <div class="my-5">
        <h1>ARBA LOGIN</h1>
    </div>
    <form method="POST" action="{{ route('arba.login') }}" class="container formulario my-5">
        @csrf
        <div class="my-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="my-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
    </form>
</body>
</html>