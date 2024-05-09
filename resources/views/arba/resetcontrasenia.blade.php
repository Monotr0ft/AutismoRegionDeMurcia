<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARBA Inicio de Sesión</title>
    @include('bootstrap.css')
    <link rel="stylesheet" href="{{ asset('assets/css/arbalogin.css') }}">
</head>
<body class="container-fluid d-flex flex-column justify-content-center">
    <div class="my-5 text-center d-flex flex-column justify-content-center align-items-center">
        <img src="{{ asset('assets/img/Arba-logo.webp') }}" alt="ARBA" class="img-fluid" style="width: 400px">
        <br>
        <h1 style="color: white;">ARBA LOGIN</h1>
        @if ($errors->any())
            <h4 class="text-danger text-center p-4" style="background-color: whitesmoke; border-radius: 10px">{{ $errors->first() }}</h4>
        @endif
    </div>
    <div class="row">
        <div class="col-12 col-lg-4">

        </div>
        <form method="POST" action="{{ route('arba.cambiocontrasenia', $token) }}" class="container formulario col-12 col-lg-4">
            @csrf
            <div class="my-3">
                <label for="dni" class="form-label">DNI</label>
                <input type="text" name="dni" id="dni" class="form-control" required>
            </div>
            <div class="my-3">
                <label for="new_password" class="form-label">Contraseña</label>
                <input type="password" name="new_password" id="new_password" class="form-control" required>
            </div>
            <div class="my-3">
                <label for="new_password_confirmation" class="form-label">Confirmar Contraseña</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="d-grid gap-2 col-6 mx-auto my-3 btn btn-dark login btn-lg">Cambiar Contraseña</button>
        </form>
        <div class="col-12 col-lg-4">

        </div>
    </div>
    @include('bootstrap.script')
</body>
</html>