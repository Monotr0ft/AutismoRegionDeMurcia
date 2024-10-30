@extends ('autismo.index')

@section ('title')

<title>Autismo Región de Murcia - {{ $pagina->titulo }}</title>

<link rel="stylesheet" href="{{ asset('/assets/css/ckeditor.css') }}">

@stop

@section ('content')

<div class="ck-content contenido">
    {!! $pagina->contenido !!}
</div>

@stop
