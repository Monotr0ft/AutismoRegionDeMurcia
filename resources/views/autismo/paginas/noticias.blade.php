@extends ('autismo.index')

@section ('title')

    <title>Autismo Región de Murcia - Noticias</title>

@stop

@section ('content')

<div>
    <h2 class="text-center my-5">Noticias</h2>
    <div class="row my-2">
        @foreach ($noticias as $noticia)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">
                    <h3 class="card-header">{{ $noticia->titulo }}</h3>
                    <div class="card-body">
                        <a class="btn btn-primary" href="https://{{ $noticia->url }}">Ver noticia</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@stop