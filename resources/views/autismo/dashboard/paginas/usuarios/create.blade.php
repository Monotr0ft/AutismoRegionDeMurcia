@extends ('autismo.dashboard.index')

@section ('title')

    <title>Dashboard Autismo Región de Murcia - Crear usuario</title>

    <script>

        function confirmCreate() {
            return confirm('¿Estás seguro de que quieres crear este usuario?');
        }

        function confirmReset() {
            return confirm('¿Estás seguro de que quieres resetear el formulario?');
        }

        function confirmVolver() {
            return confirm('¿Estás seguro de que quieres volver?');
        }

    </script>

@stop

@section ('content')

<div class="row">
    <div class="col-12">
        <h1 class="text-center">Crear usuario</h1>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <form action="" method="POST" onreset="return confirmReset()" onsubmit="return confirmCreate()">
            @csrf
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <br>
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <br>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Crear</button>
                <button type="reset" class="btn btn-warning">Resetear</button>
                <a href="{{ route('dashboard.usuarios') }}" class="btn btn-secondary" onclick="return confirmVolver()">Volver</a>
            </div>
        </form>
    </div>
    <div class="col-md-3"></div>
</div>

@stop
