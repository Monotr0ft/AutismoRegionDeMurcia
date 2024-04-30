@extends('arba.dashboard')

@section('title')

<title>ARBA - Vincular Socio</title>

<script>

    function confirmCrear() {
        return confirm('¿Estás seguro de que quieres crear una cuenta de usuario para este socio?');
    }

    function confirmVolver() {
        return confirm('¿Estás seguro de que quieres volver a la lista de socios?');
    }

</script>

@stop

@section('content')

<div>
    <h1 class="text-center">Crear cuenta de Usuario y vincularla a un Socio</h1>
    <div class="row">
        <div class="col-12 col-lg-4">

        </div>
        <form action="{{ route('arba.user') }}" method="POST" class="container my-5 col-12 col-lg-4" onsubmit="return confirmCrear()">
            @csrf
            <h2>Socio</h2>
            <select name="socio_id" class="form-select">
                <option value="0" selected>Selecciona un socio</option>
                @foreach($socios as $socio)
                    <option value="{{ $socio->id }}">{{ $socio->nombre }} {{ $socio->apellido1 }} {{ $socio->apellido2 }}</option>
                @endforeach
            </select>
            <br>
            <h2>Usuario</h2>
            <div class="form-group">
                <label for="contraseña">Contraseña</label>
                <input type="password" class="form-control" name="contraseña" id="contraseña" placeholder="Contraseña" required>
            </div>
            <br>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Crear</button>
                <a href="{{ route('arba.socio') }}" class="btn btn-secondary" onclick="return confirmVolver()">Volver</a>
            </div>
        </form>
        <div class="col-12 col-lg-4">

        </div>
    </div>
</div>

@stop