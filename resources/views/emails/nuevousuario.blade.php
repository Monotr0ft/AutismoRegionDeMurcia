@extends ('emails.dashboard')

@section ('title')

    <title>Nuevo usuario ARM</title>

@stop

@section ('content')

    <main style="background-color: #ffffff; border-radius: 2px; box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4px 0 rgba(0, 0, 150, 0.015); width: 570px; margin: 0 auto; border: 1px solid #e8e5ef;">
        <h1 style="font-size: 18px; font-weight: bold; margin-top: 0; color: #3d4852; text-align: left;">Bienvenido a ARM (Autismo Región de Murcia)</h1>

        <p style="margin-top: 0; font-size: 16px; line-height: 1.5; text-align: left;">Hola {{ $user->name }},</p>

        <p style="margin-top: 0; font-size: 16px; line-height: 1.5; text-align: left;">Se ha creado un usuario con tu correo electrónico ({{ $user->email }}) en ARM. Tu contraseña temporal es: <strong>{{ $password }}</strong></p>

        <p style="margin-top: 0; font-size: 16px; line-height: 1.5; text-align: left;">Por favor, cambia tu contraseña después de iniciar sesión.</p>

        <a href="{{ $url . '/login' }}" style="width: 30%; margin: 30px auto; display: block; text-align: center; background-color: #3d4852; color: #ffffff; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Iniciar sesión</a>
    </main>

@stop

@section ('footer')
        
    <p style="font-size: 14px; line-height: 1.5; text-align: center; color: #6c757d;">
        Si tienes algún problema, por favor, contacta con uno de los administradores
    </p>

@stop