@extends ('arba.dashboard')

@section ('title')

    <title>ARBA - Proyecto {{ $proyecto->nombre }}</title>

@stop

@section ('content')

<div class="row">
    <div class="col-12 col-lg-3"></div>
    <div class="col-12 col-lg-6">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Proyecto {{ $proyecto->nombre }}</h1>
                <img src="{{ asset($proyecto->logo) }}" alt="{{ $proyecto->nombre }}" class="img-fluid" width="200">
            </div>
            <br>
            <div class="d-flex justify-content-center col-12">
                <a href="{{ action([\App\Http\Controllers\ProyectoController::class, 'getEdit'], $proyecto->id) }}" class="btn btn-warning m-2">Editar Proyecto</a>
                <a href="{{ route('arba.proyecto') }}" class="btn btn-secondary m-2">Volver a Proyectos</a>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <h2 class="text-center">Datos del Proyecto</h2>
            </div>
            <div class="col-12 col-md-6 text-center">
                <p><strong>Nombre:</strong> {{ $proyecto->nombre }}</p>
                <p><strong>Ubicación:</strong> {{ $proyecto->ubicacion }}</p>
                <p><strong>Coordenadas:</strong> {{ $proyecto->coordenadas }}</p>
            </div>
            <div class="col-12 col-md-6 text-center">
                <p><strong>Descripción:</strong> {{ $proyecto->descripcion }}</p>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-3"></div>
</div>

@stop