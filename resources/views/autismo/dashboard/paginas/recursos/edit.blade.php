@extends ('autismo.dashboard.index')

@section ('title')

<title>Dashboard Autismo Región de Murcia - Editar recurso {{ $recurso->titulo }}</title>

@endsection

@section ('content')

<div class="row">
    <div class="col-12">
        <h1 class="text-center">Editar recurso {{ $recurso->titulo }}</h1>
    </div>
</div>
<br>
<div class="row">
    <div class="col-12">
        <form action="{{ route('dashboard.recursos.update', $recurso->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $recurso->titulo }}" required>
            </div>
            <br>
            <div class="form-group">
                <label for="tipo">Tipo</label>
                <div class="text-center" id="tipo">
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="tipo" id="urlTipo" value="urlTipo" @if ($recurso->url != null) checked @endif>
                        <label class="form-check-label" for="urlTipo">
                            URL
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="tipo" id="archivoTipo" value="archivoTipo" @if ($recurso->archivo != null) checked @endif>
                        <label class="form-check-label" for="archivoTipo">
                            Archivo
                        </label>
                    </div>
                </div>
            </div>
            <br>
            <div class="form-group" style="display: block;" id="urlDiv">
                <label for="url">URL</label>
                <input type="text" class="form-control" id="url" name="url" value="{{ $recurso->url }}">
            </div>
            <div class="form-group" style="display: none;" id="archivoDiv">
                <label for="archivo">Archivo</label>
                <input type="file" class="form-control" id="archivo" name="archivo">
            </div>
            <br>
            <div class="form-group">
                <label for="etiquetas">Etiquetas</label>
                <div class="text-center" id="etiquetas">
                    @foreach ($etiquetas as $etiqueta)
                        <div class="form-check-inline">
                            <input class="form-check-input" type="checkbox" name="etiquetas[]" id="etiqueta{{ $etiqueta->id }}" value="{{ $etiqueta->id }}" @if ($recurso->etiquetas->contains($etiqueta->id)) checked @endif>
                            <label class="form-check-label" for="etiqueta{{ $etiqueta->id }}">
                                {{ $etiqueta->nombre }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Editar recurso</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('urlTipo').addEventListener('change', function() {
        document.getElementById('urlDiv').style.display = 'block';
        document.getElementById('archivoDiv').style.display = 'none';
    });

    document.getElementById('archivoTipo').addEventListener('change', function() {
        document.getElementById('urlDiv').style.display = 'none';
        document.getElementById('archivoDiv').style.display = 'block';
    });
</script>

@endsection
