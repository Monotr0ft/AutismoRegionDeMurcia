@extends ('autismo.dashboard.index')

@section ('title')

    <title>Dashboard Autismo Región de Murcia - Crear noticia</title>
    <script>

        function confirmSubmit() {
            return confirm('¿Estás seguro de que quieres crear esta noticia?');
        }

        function confirmReset() {
            return confirm('¿Estás seguro de que quieres resetear los campos?');
        }

        function confirmBack() {
            return confirm('¿Estás seguro de que quieres volver?');
        }

    </script>

@stop

@section ('content')

<div class="row">
    <div class="col-12">
        <h1 class="text-center">Crear noticia</h1>
    </div>
</div>
<br>
<div class="d-flex justify-content-center">
    <div class="col-12 col-md-3"></div>
    <div class="col-12 col-md-6">
        <form action="{{ route('dashboard.noticias.store') }}" method="POST" onsubmit="return confirmSubmit()" onreset="return confirmReset()">
            @csrf
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <br>
            <div class="form-group">
                <label for="url">URL</label>
                <input type="text" class="form-control" id="url" name="url" required>
            </div>
            <br>
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>
            <br>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-submit">Crear</button>
                <button type="reset" class="btn btn-danger">Resetear</button>
                <a href="{{ route('dashboard.noticias') }}" class="btn btn-secondary" onclick="return confirmBack()">Volver</a>
            </div>
        </form>
    </div>
    <div class="col-12 col-md-3"></div>
</div>

@stop
