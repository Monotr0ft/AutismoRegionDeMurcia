@extends ('autismo.dashboard.index')

@section ('title')

    <title>Dashboard Autismo Región de Murcia - Crear usuario</title>

    <script>

    function confirmEdit() {
        var razon = prompt("Por favor, indique la razón para cambiar el email y/o restaurar la contraseña de este usuario:");
        if (razon === null || razon.trim() === "") {
            alert("Debe proporcionar una razón para cambiar el email y/o restaurar la contraseña del usuario.");
            return false;
        }

        var form = event.target.closest('form');
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'razon';
        input.value = razon;
        form.appendChild(input);

        return true;
    }

        function confirmVolver() {
            return confirm('¿Estás seguro de que quieres volver?');
        }

    </script>

@stop

@section ('content')

<div class="row">
    <div class="col-12">
        <h1 class="text-center">Editar usuario {{ $user->name }}</h1>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <form action="{{ route('dashboard.usuarios.update', $user->id) }}" method="POST" onsubmit="return confirmEdit()">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <br>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" value="true" id="reset" name="reset">
                <label class="form-check-label" for="reset">Restaurar contraseña</label>
            </div>
            <br>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-warning">Editar</button>
                <a href="{{ route('dashboard.usuarios') }}" class="btn btn-secondary" onclick="return confirmVolver()">Volver</a>
            </div>
        </form>
    </div>
    <div class="col-md-3"></div>
</div>

@stop
