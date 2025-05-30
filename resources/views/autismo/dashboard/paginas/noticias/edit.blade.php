@extends ('autismo.dashboard.index')

@section ('title')

    <title>Dashboard Autismo Región de Murcia - Editar noticia {{ $noticia->titulo }}</title>
    <script>

        function confirmSubmit() {
            return confirm('¿Estás seguro de que quieres editar esta noticia?');
        }

        function confirmBack() {
            return confirm('¿Estás seguro de que quieres volver?');
        }

    </script>

@stop

@section ('content')

<div class="row">
    <div class="col-12">
        <h1 class="text-center">Editar noticia</h1>
        <h2 class="text-center">{{ $noticia->titulo }}</h2>
    </div>
</div>
<br>
<div class="d-flex justify-content-center">
    <div class="col-12 col-md-3"></div>
    <div class="col-12 col-md-6">
        <form action="{{ route('dashboard.noticias.update', $noticia->id) }}" method="POST" onsubmit="return confirmSubmit()">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="titulo">Título de la Noticia</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $noticia->titulo }}" required>
            </div>
            <br>
            <div class="form-group">
                <label for="url">URL de la Noticia</label>
                <input type="text" class="form-control" id="url" name="url" value="{{ $noticia->url }}" required>
            </div>
            <br>
            <div class="form-group">
                <label for="fecha">Fecha de publicación de la Noticia</label>
                <input type="date" class="form-control" id="fecha" name="fecha" value="{{ $noticia->fecha }}" required>
            </div>
            <br>
            <div class="form-group">
                <label for="comentario">Comentario (opcional)</label>
                <textarea class="form-control" id="comentario" name="comentario" rows="3">{{ $noticia->comentario }}</textarea>
            </div>
            <br>
            <div class="d-flex justify-content-around">
                <button type="submit" class="btn btn-warning">Editar</button>
                <a href="{{ route('dashboard.noticias') }}" class="btn btn-secondary" onclick="return confirmBack()">Volver</a>
            </div>
        </form>
    </div>
    <div class="col-12 col-md-3"></div>
</div>

@stop

