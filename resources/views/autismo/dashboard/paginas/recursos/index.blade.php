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
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Recurso</th>
                    <th>Etiquetas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recursos as $recurso)
                <tr>
                    <td>{{ $recurso->titulo }}</td>
                    <td class="text-truncate" style="max-width: 150px;">
                        @if ($recurso->descripcion != null)
                            {{ $recurso->descripcion }}
                        @endif
                    </td>
                    <td class="text-truncate" style="max-width: 150px;">
                        @if ($recurso->url != null)
                            <a href="https://{{ $recurso->url }}" target="_blank">Ver recurso</a>
                        @else
                            <a href="{{ asset($recurso->archivo) }}" target="_blank">Ver recurso</a>
                        @endif
                    </td>
                    <td>
                        @foreach ($recurso->etiquetas as $etiqueta)
                            <span class="badge rounded-pill text-bg-primary">{{ $etiqueta->nombre }}</span>
                        @endforeach
                    </td>
                    <td>
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
