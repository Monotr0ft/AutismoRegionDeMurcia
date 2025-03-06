@extends ('emails.newsletter')

@section ('content')

    <h1 style="font-size: 18px; font-weight: bold; margin-top: 0; color: #007bff; text-align: left;">Se ha creado un nuevo recurso en ARM</h1>

    <p style="margin-top: 0; font-size: 16px; line-height: 1.5; text-align: left;">Un nuevo recurso se ha añadido a nuestra página web. Puedes verlo en el siguiente enlace:</p>

    <a href="{{ $url }}" style="width: 30%; margin: 30px auto; display: block; text-align: center; background-color: #007bff; color: #ffffff; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Ver el recurso</a>

@stop
