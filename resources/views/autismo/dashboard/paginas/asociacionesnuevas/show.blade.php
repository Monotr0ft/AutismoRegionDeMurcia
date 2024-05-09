@extends('autismo.dashboard.index')

@section('title')

    <title>Dashboard Autismo Región de Murcia - Asociaciones Nuevas</title>

    <script>
        function confirmVolver() {
            return confirm('¿Estás seguro de que quieres volver a Asociaciones Nuevas?');
        }
    </script>

@stop

@section('content')

<div class="row">
    <div class="col-12 col-lg-3"></div>
    <div class="col-12 col-lg-6">
        <div class="row">
            <div class="col-12 text-center">
                <h1>{{ $asociacion->tipo }} {{ $asociacion->nombre }}</h1>
                <br>
                <img src="{{ asset($asociacion->logo) }}" alt="{{ $asociacion->nombre }}" class="img-fluid" width="200">
            </div>
            <br>
            <div class="d-flex justify-content-center col-12">
                <a href="{{ action([\App\Http\Controllers\AsociacionNuevaController::class, 'getEdit'], $asociacion->id) }}" class="btn btn-warning m-2">Editar Asociación</a>
                <a href="{{ route('dashboard.asociacionesnuevas') }}" onclick="return confirmVolver()" class="btn btn-secondary m-2">Volver a Asociaciones</a>
            </div>
            <br>
        </div>
        <div>
            <h2 class="text-center">Datos de la Asociación</h2>
            <div class="row">
                <div class="col-12 col-md-6 text-center">
                    <p><strong>Tipo:</strong> {{ $asociacion->tipo }}</p>
                    <p><strong>Dirección:</strong> {{ $asociacion->direccion }}</p>
                    <p><strong>Teléfono:</strong> {{ $asociacion->telefono }}</p>
                    <p><strong>Email:</strong> {{ $asociacion->email }}</p>
                    <p><strong>Web:</strong> {{ $asociacion->web }}</p>
                </div>
                <div class="col-12 col-md-6 text-center">
                    @if ($asociacion->redes_sociales == null)
                        <p><strong>Redes Sociales:</strong> No tiene redes sociales</p>
                    @else
                        <p><strong>Redes Sociales:</strong></p>
                        @foreach (json_decode($asociacion->redes_sociales) as $red_social)
                            <p>{{ $red_social }}</p>
                        @endforeach
                    @endif
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center">Descripción</h2>
                </div>
                <div class="col-12 text-center">
                    <p>{{ $asociacion->descripcion }}</p>
                </div>
            </div>
            <br>
            <div class="d-flex justify-content-center align-items-center">
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-center">¿Es regional?</h2>
                    </div>
                    <div class="col-12 text-center">
                        @if ($asociacion->es_regional == 1)
                            <p>Sí</p>
                        @else
                            <p>No</p>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-center">¿Está publicada?</h2>
                    </div>
                    <div class="col-12 text-center">
                        @if ($asociacion->publicar == 1)
                            <p>Sí</p>
                        @else
                            <p>No</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop