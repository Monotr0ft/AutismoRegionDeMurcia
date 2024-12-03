@extends ('autismo.dashboard.index')

@section ('title')

<title>Dashboard Autismo Región de Murcia - Recursos</title>

<script>

    function confirmDelete() {
        return confirm('¿Estás seguro de que quieres eliminar este recurso?');
    }

</script>

@endsection

@section ('content')

<div class="row">
    <div class="col-12">
        <h1 class="text-center">Recursos</h1>
    </div>
</div>
<br>
<div class="text-center">
    <a href="{{ route('dashboard.recursos.create') }}" class="btn btn-primary">Crear recurso</a>
</div>
<br>
<div class="row">
    <div class="col-12 table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Título</th>
                    <th>Recurso</th>
                    <th>Etiquetas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recursos as $recurso)
                <tr>
                    <td>{{ $recurso->id }}</td>
                    <td>{{ $recurso->titulo }}</td>
                    <td>
                        @if ($recurso->url != null)
                            <a href="{{ $recurso->url }}">Ver recurso</a>
                        @else

                        @endif
                    </td>
                    <td>
                        @foreach ($recurso->etiquetas as $etiqueta)
                            <span class="badge badge-primary">{{ $etiqueta->nombre }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('dashboard.recursos.show', $recurso->id) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('dashboard.recursos.edit', $recurso->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('dashboard.recursos.delete', $recurso->id) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete()">
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

@endsection
