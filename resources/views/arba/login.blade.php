<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARBA Inicio de Sesión</title>
    @include('bootstrap.index')
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
</head>
<body>
    <form method="POST" action="{{ route('arba.login') }}">
        @csrf
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" required>
        <button type="submit">Iniciar sesión</button>
    </form>
</body>
</html>