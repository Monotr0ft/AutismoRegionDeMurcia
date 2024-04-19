@extends('autismo.dashboard.index')

@section('title')

    <title>Dashboard Autismo Región de Murcia - Asociaciones</title>
    <script>

        function confirmDelete() {
            return confirm('¿Estás seguro de que quieres eliminar esta asociación?');
        }

    </script>

@stop

@section('content')

    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Asociaciones</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Logo</th>
                        <th>Tipo</th>
                        <th class="d-none d-md-table-cell">Dirección</th>
                        <th class="d-none d-md-table-cell">Teléfono</th>
                        <th class="d-none d-md-table-cell">Email</th>
                        <th class="d-none d-lg-table-cell">Web</th>
                        <th class="d-none d-lg-table-cell">Redes Sociales</th>
                        <th class="d-none d-lg-table-cell">Descripción</th>
                        <th class="d-none d-lg-table-cell">¿Es regional?</th>
                        <th class="d-none d-lg-table-cell">¿Está publicada?</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($asociaciones as $asociacion)
                        <tr>
                            <td>{{ $asociacion->nombre }}</td>
                            <td><img src="{{ asset($asociacion->logo) }}" alt="{{ $asociacion->nombre }}" class="img-fluid" width="200"></td>
                            <td>{{ $asociacion->tipo }}</td>
                            <td class="d-none d-md-table-cell">{{ $asociacion->direccion }}</td>
                            <td class="d-none d-md-table-cell">{{ $asociacion->telefono }}</td>
                            <td class="d-none d-md-table-cell">{{ $asociacion->email }}</td>
                            <td class="d-none d-lg-table-cell">{{ $asociacion->web }}</td>
                            <td class="d-none d-lg-table-cell">
                                @if ($asociacion->redes_sociales == null)
                                    No tiene redes sociales
                                @else
                                    @foreach (json_decode($asociacion->redes_sociales) as $red_social)
                                        {{ $red_social }}<br>
                                    @endforeach
                                @endif
                            </td>
                            <td class="d-none d-lg-table-cell">Solo se puede ver en el apartado "Ver"</td>
                            @if ($asociacion->es_regional == 1)
                                <td class="d-none d-lg-table-cell">Sí</td>
                            @else
                                <td class="d-none d-lg-table-cell">No</td>
                            @endif
                            @if ($asociacion->publicar == 1)
                                <td class="d-none d-lg-table-cell">Sí</td>
                            @else
                                <td class="d-none d-lg-table-cell">No</td>
                            @endif
                            <td>
                                <a href="{{ route('dashboard.asociaciones.show', $asociacion->id) }}" class="btn btn-primary">Ver</a>
                                <a href="{{ action([\App\Http\Controllers\AsociacionController::class, 'getEdit'], $asociacion->id) }}" class="btn btn-warning">Editar</a>
                                <form action="{{ route('dashboard.asociaciones.delete', $asociacion->id) }}" method="POST" onsubmit="confirmDelete()" class="d-inline">
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