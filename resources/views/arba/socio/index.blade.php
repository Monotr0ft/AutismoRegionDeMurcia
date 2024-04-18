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
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>DNI</th>
                        <th class="d-none d-md-table-cell">Telefono</th>
                        <th class="d-none d-md-table-cell">Email</th>
                        <th class="d-none d-lg-table-cell">Posición en la Junta Directiva</th>
                        <th class="d-none d-lg-table-cell">Dirección</th>
                        <th class="d-none d-md-table-cell">Estado</th>
                        <th class="d-none d-lg-table-cell">¿Tiene acceso a la web?</th>
                        <th class="d-none d-lg-table-cell">¿Tiene cuenta de usuario?</th>
                        <th class="d-none d-lg-table-cell">Fecha de Alta</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($socios as $socio)
                        <tr>
                            <td>{{ $socio->nombre }}</td>
                            <td>{{ $socio->apellido1 }} {{ $socio->apellido2 }}</td>
                            <td>{{ $socio->dni }}</td>
                            <td class="d-none d-md-table-cell">{{ $socio->telefono }}</td>
                            <td class="d-none d-md-table-cell">{{ $socio->email }}</td>
                            @if ($socio->junta_directiva == 1)
                                <td class="d-none d-lg-table-cell">{{ $socio->posicion }}</td>
                            @else
                                <td class="d-none d-lg-table-cell">No pertenece a la junta directiva</td>
                            @endif
                            @if ($socio->direccionArba->ampliacion == null)
                                <td class="d-none d-lg-table-cell">{{ $socio->direccionArba->tipo_via }} {{ $socio->direccionArba->nombre_via }} {{ $socio->direccionArba->numero }}, {{ $socio->direccionArba->provincia }}, {{ $socio->direccionArba->municipio }}, {{ $socio->direccionArba->localidad }}, {{ $socio->direccionArba->codigo_postal }}</td>
                            @else
                                <td class="d-none d-lg-table-cell">{{ $socio->direccionArba->tipo_via }} {{ $socio->direccionArba->nombre_via }} {{ $socio->direccionArba->numero }} {{ $socio->direccionArba->ampliacion }}, {{ $socio->direccionArba->provincia }}, {{ $socio->direccionArba->municipio }}, {{ $socio->direccionArba->localidad }}, {{ $socio->direccionArba->codigo_postal }}</td>
                            @endif
                            @if ($socio->activo == 1)
                                <td class="d-none d-md-table-cell">Activo</td>
                            @else
                                <td class="d-none d-md-table-cell">Inactivo</td>
                            @endif
                            @if ($socio->acceso_web == 1)
                                <td class="d-none d-lg-table-cell">Sí</td>
                            @else
                                <td class="d-none d-lg-table-cell">No</td>
                            @endif
                            @if ($socio->user_id == null)
                                <td class="d-none d-lg-table-cell">No</td>
                            @else
                                <td class="d-none d-lg-table-cell">Sí</td>
                            @endif
                            <td class="d-none d-lg-table-cell">{{ $socio->fecha_alta }}</td>
                            <td>
                                <a href="{{ route('arba.socio.show', $socio->id) }}" class="btn btn-primary">Ver</a>
                                <a href="{{ action([App\Http\Controllers\SocioController::class, 'getCreate']) }}" class="btn btn-warning">Editar</a>
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
