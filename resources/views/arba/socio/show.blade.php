@extends ('arba.dashboard')

@section ('title')

    <title>ARBA - Socio {{ $socio->nombre }} {{ $socio->apellido1 }} {{ $socio->apellido2 }}</title>

@stop

@section ('content')
<div class="row">
    <div class="col-12 col-lg-3"></div>
    <div class="col-12 col-lg-6">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">Socio {{ $socio->nombre }} {{ $socio->apellido1 }} {{ $socio->apellido2 }}</h1>
            </div>
            <div class="d-flex justify-content-center col-12">
                <a href="" class="btn btn-warning m-2">Editar Socio</a>
                <a href="{{ route('arba.socio') }}" class="btn btn-primary m-2">Volver a Socios</a>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <h2 class="text-center">Datos Personales</h2>
            </div>
            <div class="col-12 col-md-6 text-center">
                <p><strong>Nombre:</strong> {{ $socio->nombre }}</p>
                <p><strong>Apellidos:</strong> {{ $socio->apellido1 }} {{ $socio->apellido2 }}</p>
            </div>
            <div class="col-12 col-md-6 text-center">
                <p><strong>DNI:</strong> {{ $socio->dni }}</p>
                <p><strong>Telefono:</strong> {{ $socio->telefono }}</p>
                <p><strong>Email:</strong> {{ $socio->email }}</p>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <h2 class="text-center">Dirección</h2>
            </div>
            <div class="col-12 col-md-6 text-center">
                <p><strong>Tipo de Vía:</strong> {{ $socio->direccionArba->tipo_via }}</p>
                <p><strong>Nombre de la Vía:</strong> {{ $socio->direccionArba->nombre_via }}</p>
                <p><strong>Número:</strong> {{ $socio->direccionArba->numero }}</p>
                @if ($socio->direccionArba->ampliacion != null)
                    <p><strong>Ampliación:</strong> {{ $socio->direccionArba->ampliacion }}</p>
                @endif
            </div>
            <div class="col-12 col-md-6 text-center">
                <p><strong>Provincia:</strong> {{ $socio->direccionArba->provincia }}</p>
                <p><strong>Municipio:</strong> {{ $socio->direccionArba->municipio }}</p>
                <p><strong>Localidad:</strong> {{ $socio->direccionArba->localidad }}</p>
                <p><strong>Código Postal:</strong> {{ $socio->direccionArba->codigo_postal }}</p>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <h2 class="text-center">Datos de la Asociación</h2>
            </div>
            <div class="col-12 col-md-6 text-center">
                @if ($socio->junta_directiva == 1)
                    <p><strong>Posición en la Junta Directiva:</strong> {{ $socio->posicion }}</p>
                @else
                    <p><strong>Posición en la Junta Directiva:</strong> No pertenece a la junta directiva</p>
                @endif
                @if ($socio->activo == 1)
                    <p><strong>Estado:</strong> Activo</p>
                @else
                    <p><strong>Estado:</strong> Inactivo</p>
                @endif
            </div>
            <div class="col-12 col-md-6 text-center">
                @if ($socio->web == 1)
                    <p><strong>¿Tiene acceso a la web?</strong> Sí</p>
                @else
                    <p><strong>¿Tiene acceso a la web?</strong> No</p>
                @endif
                @if ($socio->usuario == 1)
                    <p><strong>¿Tiene cuenta de usuario?</strong> Sí</p>
                @else
                    <p><strong>¿Tiene cuenta de usuario?</strong> No</p>
                @endif
                <p><strong>Fecha de Alta:</strong> {{ $socio->created_at }}</p>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-3"></div>
</div>

@stop