@extends ('emails.dashboard')

@section ('title')

    <title>Contraseña cambiada</title>

@stop

@section ('content')

    <h1 style="font-size: 18px; font-weight: bold; margin-top: 0; color: #3d4852; text-align: left;">Contraseña cambiada</h1>

    <p style="margin-top: 0; font-size: 16px; line-height: 1.5; text-align: left;">Hola {{ $user->name }},</p>

    <p style="margin-top: 0; font-size: 16px; line-height: 1.5; text-align: left;">Si has recibido esto, puede ser porque has cambiado la contraseña. Si este es el caso, ignora el resto del email.</p>

    <p style="margin-top: 0; font-size: 16px; line-height: 1.5; text-align: left;">En caso de haberlo recibido sin cambiar la contraseña, puede ser porque un administrador ha decidido que restablezcas tu contraseña o porque alguien que no ha sido tú la ha cambiado.</p>

    <p style="margin-top: 0; font-size: 16px; line-height: 1.5; text-align: left;">En cualquiera de ambos casos, utiliza el botón para cambiar tu contraseña y avisa a un administrador de haber recibido esto.</p>

    <a href="{{ $url . '/login/' . $user->code }}" style="width: 30%; margin: 30px auto; display: block; text-align: center; background-color: #3d4852; color: #ffffff; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Cambiar contraseña</a>

@stop

@section ('footer')

    <p style="font-size: 14px; line-height: 1.5; text-align: center; color: #6c757d;">Este mensaje ha sido enviado automáticamente. Por favor, no respondas a este mensaje.</p>

@stop
