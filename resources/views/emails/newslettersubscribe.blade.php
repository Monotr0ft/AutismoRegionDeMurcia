@extends ('emails.newsletter')

@section ('content')

    <h1 style="font-size: 18px; font-weight: bold; margin-top: 0; color: #007bff; text-align: left;">Bienvenido al boletín de noticias de ARM (Autismo Región de Murcia)</h1>

    <p style="margin-top: 0; font-size: 16px; line-height: 1.5; text-align: left;">¡Gracias por suscribirte a nuestro boletín de noticias! A partir de ahora recibirás todas las novedades de nuestra página web.</p>

    <a href="{{ $url }}" style="width: 30%; margin: 30px auto; display: block; text-align: center; background-color: #007bff; color: #ffffff; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Entra a ver la página web</a>
    
@stop
