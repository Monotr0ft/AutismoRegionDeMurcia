@extends('autismo.dashboard.index')

@section('title')

    <title>Dashboard Autismo Región de Murcia - Asociaciones Nuevas</title>
    <script>

        function confirmDelete() {
            return confirm('¿Estás seguro de que quieres eliminar esta asociación?');
        }

        function confirmPublicar() {
            return confirm('¿Estás seguro de que quieres publicar esta asociación?');
        }

        function confirmOcultar() {
            return confirm('¿Estás seguro de que quieres ocultar esta asociación?');
        }

    </script>

@stop

@section('content')

    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Peticiones de Asociaciones</h1>
        </div>
    </div>
    <br>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cambiar a Asociaciones</a>
        </div>
        <div>
            <a href="{{ route('dashboard.paginas') }}" class="btn btn-secondary">Cambiar a Páginas</a>
        </div>
        <div>
            <a href="{{ route('dashboard.noticias') }}" class="btn btn-secondary">Cambiar a Noticias</a>
        </div>
    </div>
    <br>
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
                            <td class="d-flex flex-column justify-content-between align-items-center">
                                <a href="{{ route('dashboard.asociacionesnuevas.show', $asociacion->id) }}" class="btn btn-primary m-1">Ver</a>
                                <a href="{{ action([\App\Http\Controllers\AsociacionNuevaController::class, 'getEdit'], $asociacion->id) }}" class="btn btn-warning m-1">Editar</a>
                                @if ($asociacion->publicar == 0)
                                    <form action="{{ route('dashboard.asociacionesnuevas.publicar', $asociacion->id) }}" method="POST" onsubmit="return confirmPublicar()" class="d-inline m-1">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Publicar</button>
                                    </form>
                                @else
                                    <form action="{{ route('dashboard.asociacionesnuevas.ocultar', $asociacion->id) }}" method="POST" onsubmit="return confirmOcultar()" class="d-inline m-1">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Ocultar</button>
                                    </form>
                                @endif
                                <form action="{{ route('dashboard.asociacionesnuevas.delete', $asociacion->id) }}" method="POST" onsubmit="return confirmDelete()" class="d-inline m-1">
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