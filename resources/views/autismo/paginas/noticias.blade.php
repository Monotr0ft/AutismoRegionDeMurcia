@extends ('autismo.index')

@section ('title')

    <title>Autismo Región de Murcia - Noticias</title>

@stop

@section ('content')

<div class="contenido">
    <h2 class="text-center my-5">Noticias</h2>
    <div class="row my-2">
        @foreach ($noticias as $noticia)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card border-more">
                    <h3 class="card-header" style="background-color:rgb(95, 140, 207);">{{ $noticia->titulo }}</h3>
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <p class="card-text mb-0"><strong>{{ \Carbon\Carbon::parse($noticia->fecha)->format('d/m/Y') }}</strong></p>
                        <a class="btn btn-more ml-3" href="https://{{ $noticia->url }}" target="_blank">Ver noticia</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@stop