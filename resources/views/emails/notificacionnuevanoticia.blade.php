@extends ('emails.newsletter')

@section ('content')

    <h1 class="text-primary" style="font-size: 18px; font-weight: bold; margin-top: 0;" align="left">Se ha creado una nueva noticia en ARM</h1>

    <p class="lead" style="margin-top: 0;" align="left">Una nueva noticia se ha publicado en nuestra página web. Puedes leerla en el siguiente enlace:</p>

    <a href="{{ $url }}" class="btn btn-dark" style="text-align: center; width: 30%; margin: 30px auto; display: block;">Leer la noticia</a>

@stop