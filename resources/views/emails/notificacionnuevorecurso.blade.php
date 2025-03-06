@extends ('emails.newsletter')

@section ('content')

    <h1 class="text-primary" style="font-size: 18px; font-weight: bold; margin-top: 0;" align="left">Se ha creado un nuevo recurso en ARM</h1>

    <p class="lead" style="margin-top: 0;" align="left">Un nuevo recurso se ha añadido a nuestra página web. Puedes verlo en el siguiente enlace:</p>

    <a href="{{ $url }}" class="btn btn-dark" style="text-align: center; width: 30%; margin: 30px auto; display: block;">Ver el recurso</a>

@stop
