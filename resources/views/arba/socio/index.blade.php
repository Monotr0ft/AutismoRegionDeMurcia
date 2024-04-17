@extends ('arba.dashboard')

@section ('title')

    <title>ARBA - Socios</title>

@stop

@section ('content')

    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Socios</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <a href="{{ route('arba.socio.create') }}" class="btn btn-primary">Crear Socio</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>DNI</th>
                        <th>Telefono</th>
                        <th>Email</th>
                        <th>Posición en la Junta Directiva</th>
                        <th>Dirección</th>
                        <th>Estado</th>
                        <th>¿Tiene acceso a la web?</th>
                        <th>¿Tiene cuenta de usuario?</th>
                        <th>Fecha de Alta</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($socios as $socio)
                        <tr>
                            <td>{{ $socio->nombre }}</td>
                            <td>{{ $socio->apellido1 }} {{ $socio->apellido2 }}</td>
                            <td>{{ $socio->dni }}</td>
                            <td>{{ $socio->telefono }}</td>
                            <td>{{ $socio->email }}</td>
                            @if ($socio->junta_directiva == 1)
                                <td>{{ $socio->posicion }}</td>
                            @else
                                <td>No pertenece a la junta directiva</td>
                            @endif
                            @if ($socio->direccionArba->ampliacion == null)
                                <td>{{ $socio->direccionArba->tipo_via }} {{ $socio->direccionArba->nombre_via }} {{ $socio->direccionArba->numero }}, {{ $socio->direccionArba->provincia }}, {{ $socio->direccionArba->municipio }}, {{ $socio->direccionArba->localidad }}, {{ $socio->direccionArba->codigo_postal }}</td>
                            @else
                                <td>{{ $socio->direccionArba->tipo_via }} {{ $socio->direccionArba->nombre_via }} {{ $socio->direccionArba->numero }} {{ $socio->direccionArba->ampliacion }}, {{ $socio->direccionArba->provincia }}, {{ $socio->direccionArba->municipio }}, {{ $socio->direccionArba->localidad }}, {{ $socio->direccionArba->codigo_postal }}</td>
                            @endif
                            @if ($socio->activo == 1)
                                <td>Activo</td>
                            @else
                                <td>Inactivo</td>
                            @endif
                            @if ($socio->acceso_web == 1)
                                <td>Sí</td>
                            @else
                                <td>No</td>
                            @endif
                            @if ($socio->user_id == null)
                                <td>No</td>
                            @else
                                <td>Sí</td>
                            @endif
                            <td>{{ $socio->fecha_alta }}</td>
                            <td>
                                <a href="" class="btn btn-warning">Editar</a>
                                <form action="" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop
