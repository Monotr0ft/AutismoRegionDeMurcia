<!DOCTYPE html>
<html>
<head>
    <title>Nuevo usuario ARM</title>
</head>
<body style="box-sizing: border-box; position: relative; -webkit-text-size-adjust: none; color: #718096; height: 100%; line-height: 1.4; width: 100% !important; margin: 0; padding: 0; border: 1px solid #edf2f7;">
    <header style="text-align: center; padding: 25px 0;">
        <img src="{{ asset('assets/img/Murcia_-_Mapa_municipal.jpg') }}" alt="Logo de ARM" style="max-width: 100%; height: 75px; width: 75px;">
    </header>

    <main style="background-color: #ffffff; border-radius: 2px; box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4px 0 rgba(0, 0, 150, 0.015); width: 570px; margin: 0 auto; border: 1px solid #e8e5ef;">
        <h1 style="color: #3d4852; font-size: 18px; font-weight: bold; margin-top: 0;" align="left">Bienvenido a ARM (Autismo Región de Murcia)</h1>

        <p style="line-height: 1.5em; font-size: 16px; margin-top: 0;" align="left">Hola {{ $user->name }},</p>

        <p style="line-height: 1.5em; font-size: 16px; margin-top: 0;" align="left">Se ha creado un usuario con tu correo electrónico ({{ $user->email }}) en ARM. Tu contraseña temporal es: <strong>{{ $password }}</strong></p>

        <p style="line-height: 1.5em; font-size: 16px; margin-top: 0;" align="left">Por favor, cambia tu contraseña después de iniciar sesión.</p>

        <a href="{{ $url }}" style="color: #fff; text-align: center; width: 30%; border-radius: 4px; display: inline-block; overflow: hidden; text-decoration: none; background-color: #2d3748; margin: 30px auto; padding: 0; border: 8px solid #2d3748;">Iniciar sesión</a>
    </main>

    <footer style="text-align: center; width: 570px; margin: 0 auto;">
        Si tienes alguna pregunta o necesitas ayuda, por favor contáctanos.
    </footer>
</body>
</html>
