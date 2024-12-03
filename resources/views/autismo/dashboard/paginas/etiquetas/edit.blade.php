@extends ('autismo.dashboard.index')

@section ('title')

<title>Dashboard Autismo Región de Murcia - Editar etiqueta {{ $etiqueta->nombre }}</title>

<script>

    function confirmSubmit() {
        return confirm('¿Estás seguro de que quieres editar esta etiqueta?');
    }

    function confirmBack() {
        return confirm('¿Estás seguro de que quieres volver?');
    }

</script>

@endsection

@section ('content')

<div class="row">
    <div class="col-12">
        <h1 class="text-center">Editar etiqueta {{ $etiqueta->nombre }}</h1>
    </div>
</div>
<br>
<div class="d-flex justify-content-center">
    <div class="col-12 col-md-3"></div>
    <div class="col-12 col-md-6">
        <form action="{{ route('dashboard.etiquetas.update', $etiqueta->id) }}" method="POST" onsubmit="return confirmSubmit()">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <label for="nombre" class="col-12 col-form-label">Nombre</label>
                <div class="col-12">
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $etiqueta->nombre }}" required>
                </div>
            </div>
            <br>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-submit">Editar</button>
                <a href="{{ route('dashboard.etiquetas') }}" class="btn btn-secondary" onclick="return confirmBack()">Volver</a>
            </div>
        </form>
    </div>
    <div class="col-12 col-md-3"></div>
</div>

@endsection
