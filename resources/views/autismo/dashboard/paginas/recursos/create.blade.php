@extends ('autismo.dashboard.index')

@section ('title')

<title>Dashboard Autismo Región de Murcia - Crear recurso</title>

<script>

    function confirmDelete() {
        return confirm('¿Estás seguro de que quieres eliminar este recurso?');
    }

</script>

@endsection

@section ('content')

<div class="row">
    <div class="col-12">
        <h1 class="text-center">Crear recurso</h1>
    </div>
</div>
<br>
<div class="row">
    <div class="col-12">
        <form action="{{ route('dashboard.recursos.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <br>
            <div class="form-group">
                <label for="tipo">Tipo</label>
                <div class="text-center" id="tipo">
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="tipo" id="urlTipo" value="1" checked>
                        <label class="form-check-label" for="urlTipo">
                            URL
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="tipo" id="archivoTipo" value="2">
                        <label class="form-check-label" for="archivoTipo">
                            Archivo
                        </label>
                    </div>
                </div>
            </div>
            <br>
            <div class="form-group" style="display: block;" id="urlDiv">
                <label for="url">URL</label>
                <input type="text" class="form-control" id="url" name="url" required>
            </div>
            <div class="form-group" style="display: none;" id="archivoDiv">
                <label for="archivo">Archivo</label>
                <input type="file" class="form-control" id="archivo" name="archivo">
            </div>
            <br>
            <div class="form-group">
                <label for="etiquetas">Etiquetas</label>
                <div id="etiquetas-container">
                    <select class="form-control etiquetas-select" name="etiquetas[]">
                        @foreach ($etiquetas as $etiqueta)
                            <option value="{{ $etiqueta->id }}">{{ $etiqueta->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <button type="button" class="btn btn-primary" id="addEtiqueta">Añadir etiqueta</button>
            </div>
            <br>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-submit">Crear</button>
                <button type="reset" class="btn btn-danger">Resetear</button>
                <a href="{{ route('dashboard.recursos') }}" class="btn btn-secondary">Volver</a>
            </div>
        </form>
    </div>
</div>

<script>

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('urlTipo').addEventListener('click', function() {
            document.getElementById('urlDiv').style.display = 'block';
            document.getElementById('archivoDiv').style.display = 'none';
        });
        document.getElementById('archivoTipo').addEventListener('click', function() {
            document.getElementById('urlDiv').style.display = 'none';
            document.getElementById('archivoDiv').style.display = 'block';
        });
    });

</script>

@endsection
