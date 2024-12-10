@extends ('autismo.dashboard.index')

@section ('title')

<title>Dashboard Autismo Región de Murcia - Recurso {{ $recurso->title }}</title>

@endsection

@section ('content')

<div class="row">
    <div class="col-12 col-lg-3"></div>
    <div class="col-12 col-lg-6">
        <div class="row">
            <div class="col-12 text-center">
                <h1>{{ $recurso->titulo }}</h1>
                <br>
                @if ($recurso->url != null)
                    <a href="https://{{ $recurso->url }}" target="_blank">Ver recurso</a>
                @else
                    <a href="{{ asset($recurso->archivo) }}" target="_blank">Ver recurso</a>
                @endif
            </div>
            <br>
            <div class="d-flex justify-content-center col-12">
                <a href="{{ route('dashboard.recursos.edit', $recurso->id) }}" class="btn btn-warning m-2">Editar Recurso</a>
                <a href="{{ route('dashboard.recursos') }}" onclick="return confirmVolver()" class="btn btn-secondary m-2">Volver a Recursos</a>
            </div>
            <br>
        </div>
        <div>
            <h2 class="text-center">Etiquetas</h2>
            <div class="row">
                <div class="col-12 text-center">
                    @foreach ($recurso->etiquetas as $etiqueta)
                        <span class="badge rounded-pill text-bg-primary">{{ $etiqueta->nombre }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-3"></div>
</div>


@endsection
