@extends ('autismo.dashboard.index')

@section ('title')

<title>Dashboard Autismo Región de Murcia - Crear etiqueta</title>

<script>
        function confirmSubmit() {
            return confirm('¿Estás seguro de que quieres crear esta etiqueta?');
        }
    
        function confirmReset() {
            return confirm('¿Estás seguro de que quieres resetear los campos?');
        }
    
        function confirmBack() {
            return confirm('¿Estás seguro de que quieres volver?');
        }
</script>

@endsection

@section ('content')

<div class="row">
    <div class="col-12">
        <h1 class="text-center">Crear etiqueta</h1>
    </div>
</div>
<br>
<div class="d-flex justify-content-center">
    <div class="col-12 col-md-3"></div>
    <div class="col-12 col-md-6">
        <form action="{{ route('dashboard.etiquetas.store') }}" method="POST" onsubmit="return confirmSubmit()" onreset="return confirmReset()">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <br>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-submit">Crear</button>
                <button type="reset" class="btn btn-danger">Resetear</button>
                <a href="{{ route('dashboard.etiquetas') }}" class="btn btn-secondary" onclick="return confirmBack()">Volver</a>
            </div>
        </form>
    </div>
    <div class="col-12 col-md-3"></div>
</div>

@endsection
