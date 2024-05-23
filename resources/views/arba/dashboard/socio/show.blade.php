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
                <a href="{{ action([\App\Http\Controllers\SocioController::class, 'getEdit'], $socio->id) }}" class="btn btn-warning m-2">Editar Socio</a>
                <a href="{{ route('arba.socio') }}" class="btn btn-secondary m-2">Volver a Socios</a>
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
                    <p><strong>Cargo en la Junta Directiva:</strong> {{ $socio->posicion }}</p>
                @else
                    <p><strong>Cargo en la Junta Directiva:</strong> No pertenece a la junta directiva</p>
                @endif
                @if ($socio->activo == 1)
                    <p><strong>Estado:</strong> Activo</p>
                @else
                    <p><strong>Estado:</strong> Inactivo</p>
                @endif
                <p><strong>Fecha de Alta:</strong> {{ $socio->fecha_alta }}</p>
                @if ($socio->fecha_baja != null)
                    <p><strong>Fecha de Baja:</strong> {{ $socio->fecha_baja }}</p>
                @endif
            </div>
            <div class="col-12 col-md-6 text-center">
                @if ($socio->acceso_web == 1)
                    <p><strong>¿Tiene acceso a la web?</strong> Sí</p>
                @else
                    <p><strong>¿Tiene acceso a la web?</strong> No</p>
                @endif
                @if ($socio->user_id != null)
                    <p><strong>¿Tiene cuenta de usuario?</strong> Sí</p>
                @else
                    <p><strong>¿Tiene cuenta de usuario?</strong> No</p>
                @endif
                <div class="d-flex justify-content-center align-items-center">
                    <p><strong>Lugares que tiene acceso:</strong></p>
                    <ul class="text-start">
                        @if ($socio->administracion == 1)
                            <li>Administración</li>
                        @endif
                        @if ($socio->vivero == 1)
                            <li>Vivero</li>
                        @endif
                        @if ($socio->partes_trabajo == 1)
                            <li>Partes de Trabajo</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-3"></div>
</div>

@stop