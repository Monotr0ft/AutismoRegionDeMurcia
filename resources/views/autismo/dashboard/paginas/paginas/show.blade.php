@extends ('autismo.dashboard.index')

@section ('title')

    <title>Dashboard Autismo Región de Murcia - Página {{ $pagina->titulo }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/ckeditor.css') }}">

@stop

@section ('content')

<div>
    <h1 class="text-center">Página {{ $pagina->titulo }}</h1>
    <br>
    <div class="d-flex justify-content-evenly align-items-center">
        <a href="{{ action([\App\Http\Controllers\PaginaController::class, 'getEdit'], $pagina->id) }}" class="btn btn-warning">Editar</a>
        <a href="{{ route('dashboard.paginas') }}" class="btn btn-secondary">Volver</a>
    </div>
    <br>
    <div class="ck-content" style="border: 2px solid black">
        {!! $pagina->contenido !!}
    </div>
</div>

@stop