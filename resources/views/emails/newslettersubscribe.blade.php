@extends ('emails.newsletter')

@section ('content')

    <h1 class="text-primary" style="font-size: 18px; font-weight: bold; margin-top: 0;" align="left">Bienvenido al boletín de noticias de ARM (Autismo Región de Murcia)</h1>

    <p class="lead" style="margin-top: 0;" align="left">¡Gracias por suscribirte a nuestro boletín de noticias! A partir de ahora recibirás todas las novedades de nuestra página web.</p>

    <a href="{{ $url }}" class="btn btn-primary" style="width: 30%; margin: 30px auto; display: block; text-align: center;">Entra a ver la página web</a>

@stop
