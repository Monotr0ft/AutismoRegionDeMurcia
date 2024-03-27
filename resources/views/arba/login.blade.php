<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARBA Inicio de Sesión</title>
</head>
<body>
    @if(Auth::guard('arba')->check())
        <form method="POST" action="{{ route('arba.logout') }}">
            @csrf
            <button type="submit">Cerrar sesión</button>
        </form>
    @else
        <form method="POST" action="{{ route('arba.login') }}">
            @csrf
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" required>
            <button type="submit">Iniciar sesión</button>
        </form>
    @endif
</body>
</html>