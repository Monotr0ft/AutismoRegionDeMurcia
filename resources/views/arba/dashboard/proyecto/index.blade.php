@extends ('arba.dashboard')

@section ('title')

    <title>ARBA - Proyectos</title>
    <script>
        function confirmDelete() {
            return confirm('¿Estás seguro de que quieres eliminar este proyecto?');
        }
    </script>

@stop

@section ('content')

<div class="row">
    <div class="col-12">
        <h1 class="text-center">Proyectos</h1>
    </div>
</div>
<br>
<div class="row">
    <div class="col-12 d-flex justify-content-between">
        <a href="{{ action([\App\Http\Controllers\ProyectoController::class, 'getCreate']) }}" class="btn btn-primary">Crear Proyecto</a>
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
                    <th>Ubicacion</th>
                    <th>Coordenadas</th>
                    <th class="d-none d-lg-table-cell">Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proyectos as $proyecto)
                    <tr>
                        <td>{{ $proyecto->nombre }}</td>
                        <td><img src="{{ asset($proyecto->logo) }}" alt="{{ $proyecto->nombre }}" class="img-fluid" width="200"></td>
                        <td>{{ $proyecto->ubicacion }}</td>
                        <td>{{ $proyecto->coordenadas }}</td>
                        <td class="d-none d-lg-table-cell">Solo se puede ver en el apartado "Ver"</td>
                        <td class="d-flex flex-column justify-content-between align-items-center">
                            <a href="{{ route('arba.proyecto.show', $proyecto->id) }}" class="btn btn-primary m-1">Ver</a>
                            <a href="{{ action([\App\Http\Controllers\ProyectoController::class, 'getEdit'], $proyecto->id) }}" class="btn btn-warning m-1">Editar</a>
                            <form action="{{ route('arba.proyecto.delete', $proyecto->id) }}" method="POST" class="d-inline m-1" onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" >Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop
