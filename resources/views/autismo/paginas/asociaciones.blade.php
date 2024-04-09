@extends('autismo.index')

@section('title')

<title>Autismo Región de Murcia - Asociaciones</title>

@stop

@section('content')

<div>
    <div class="text-center my-5">
        <h2>Asociaciones de Trastorno del Espectro Autista<br>en la Región de Murcia</h2>
    </div>
    <div class="row">
        @foreach ($asociaciones as $asociacion)
        <div class="col-12 col-md-6 col-lg-4 my-3 d-flex align-items-stretch">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">{{ $asociacion->nombre }}</h3>
                </div>
                <div class="card-body">
                    <p>{{ $asociacion->descripcion }}</p>
                    <ul>
                        <li>Tipo: {{ $asociacion->tipo }}</li>
                        @if ($asociacion->direccion != null)
                        <li>Dirección: {{ $asociacion->direccion }}</li>
                        @endif
                        @if ($asociacion->telefono != null)
                        <li>Teléfono: {{ $asociacion->telefono }}</li>
                        @endif
                        <li>Email: <a href="mailto:{{ $asociacion->email }}">{{ $asociacion->email }}</a></li>
                        <li>Web: <a href="https://{{ $asociacion->web }}">{{ $asociacion->web }}</a></li>
                        @if ($asociacion->redes_sociales != null)
                        <li>Redes sociales:
                            <ul>
                                @foreach (json_decode($asociacion->redes_sociales) as $red_social)
                                <li><a href="https://{{ $red_social }}">{{ $red_social }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@stop