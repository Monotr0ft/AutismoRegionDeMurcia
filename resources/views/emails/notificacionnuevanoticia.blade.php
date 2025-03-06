@extends ('emails.newsletter')

@section ('content')

    <h1 style="font-size: 18px; font-weight: bold; margin-top: 0; color: #007bff; text-align: left;">Se ha creado una nueva noticia en ARM</h1>

    <p style="margin-top: 0; font-size: 16px; line-height: 1.5; text-align: left;">Una nueva noticia se ha publicado en nuestra página web. Puedes leerla en el siguiente enlace:</p>

    <a href="{{ $url }}" style="width: 30%; margin: 30px auto; display: block; text-align: center; background-color: #007bff; color: #ffffff; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Leer la noticia</a>

@stop