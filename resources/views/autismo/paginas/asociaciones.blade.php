@extends('autismo.index')

@section('title')

<title>Autismo Región de Murcia - Asociaciones</title>

@stop

@section('content')

<div class="contenido">
    <div class="text-center my-5">
        <h2>Asociaciones de Trastorno del Espectro Autista<br>en la Región de Murcia</h2>
    </div>
    <div class="row">
        @foreach ($asociaciones as $asociacion)
        <div class="col-12 col-md-6 col-lg-4 my-3 d-flex align-items-stretch">
            <div class="card">
                <div class="card-header text-center" style="background-color: #FFFFFF;">
                    <a href="https://{{ $asociacion->web }}" target="_blank"><img src="{{ asset($asociacion->logo) }}" class="img-fluid" style="height: 200px;" alt="{{ $asociacion->nombre }}"></a>
                    <br><br>
                    <a href="https://{{ $asociacion->web }}" class="text-decoration-none" style="color: black" target="_blank"><h3>{{ $asociacion->nombre }}</h3></a>
                </div>
                <div class="card-body" style="background-color: rgb(148, 187, 245);">
                    <div class="ck-content">{!! $asociacion->descripcion !!}</div>
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
    <div class="text-center my-3">
        <h4>Si perteneces a una asociación específica del Espectro Autista en la Región de Murcia</h4>
        <h4>y quieres que aparezcas en esta web, pulsa en el botón que hay abajo.</h4>
        <br>
        <a href="{{ route('asociaciones.create') }}" class="btn btn-more">Añadir Asociación</a>
    </div>
</div>

@stop