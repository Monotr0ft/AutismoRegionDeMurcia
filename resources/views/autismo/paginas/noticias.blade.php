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
                <div class="card">
                    <h3 class="card-header" style="background-color: #788AA3;">{{ $noticia->titulo }}</h3>
                    <div class="card-body" style="background-color: #CCCCCC;">
                        <a class="btn btn-more" href="https://{{ $noticia->url }}" target="_blank">Ver noticia</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@stop