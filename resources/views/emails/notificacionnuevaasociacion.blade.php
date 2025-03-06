@extends ('emails.newsletter')

@section ('content')

    <h1 class="text-primary font-weight-bold" style="font-size: 18px; margin-top: 0;" align="left">Se ha creado una nueva asociación en ARM</h1>

    <p class="lead" style="margin-top: 0;" align="left">La asociación <strong>{{ $asociacion->nombre }}</strong> se ha unido a la familia de ARM. A partir de ahora, podrás ver toda la información de esta asociación en nuestra página web.</p>

    <a href="{{ $url }}" class="btn btn-dark" style="width: 30%; margin: 30px auto; display: block; text-align: center;">Ver las asociaciones</a>

@stop
