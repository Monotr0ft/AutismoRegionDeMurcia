@extends ('arba.dashboard')

@section ('title')

    <title>ARBA - Socios</title>
    <script>
        function confirmDelete() {
            return confirm('¿Estás seguro de que quieres eliminar este socio?');
        }
    </script>

@stop

@section ('content')

    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Socios</h1>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12 d-flex justify-content-between">
            <a href="{{ route('arba.socio.create') }}" class="btn btn-primary">Crear Socio</a>
            <a href="{{ action([\App\Http\Controllers\SocioController::class, 'getUser']) }}" class="btn btn-primary">Vincular Socio a Usuario</a>
        </div>
    </div>
    <br>
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
                        <th class="d-none d-lg-table-cell">Cargo en la Junta Directiva</th>
                        <th class="d-none d-lg-table-cell">Dirección</th>
                        <th class="d-none d-md-table-cell">Estado</th>
                        <th class="d-none d-lg-table-cell">¿Tiene cuenta de usuario?</th>
                        <th class="d-none d-lg-table-cell">¿Tiene acceso a la web?</th>
                        <th class="d-none d-lg-table-cell">Lugares que tiene acceso</th>
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
                            @if ($socio->user_id == null)
                                <td class="d-none d-lg-table-cell">No</td>
                            @else
                                <td class="d-none d-lg-table-cell">Sí</td>
                            @endif
                            @if ($socio->acceso_web == 1)
                                <td class="d-none d-lg-table-cell">Sí</td>
                            @else
                                <td class="d-none d-lg-table-cell">No</td>
                            @endif
                            <td class="d-none d-lg-table-cell">
                                @if ($socio->administracion == 1)
                                    Administración<br>
                                @endif
                                @if ($socio->vivero == 1)
                                    Vivero<br>
                                @endif
                                @if ($socio->partes_trabajo == 1)
                                    Partes de Trabajo<br>
                                @endif
                            </td>
                            <td class="d-none d-lg-table-cell">{{ $socio->fecha_alta }}</td>
                            <td>
                                <a href="{{ route('arba.socio.show', $socio->id) }}" class="btn btn-primary">Ver</a>
                                <a href="{{ action([\App\Http\Controllers\SocioController::class, 'getEdit'], $socio->id) }}" class="btn btn-warning">Editar</a>
                                <form action="{{ route('arba.socio.delete', $socio->id) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete()">
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
