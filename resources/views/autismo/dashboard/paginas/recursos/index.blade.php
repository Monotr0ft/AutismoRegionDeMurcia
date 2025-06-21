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
                    <td style="max-width: 150px;">
                        @if ($recurso->descripcion != null)
                            <a href="javascript:void(0);" 
                               class="text-primary ver-descripcion" 
                               style="cursor:pointer; text-decoration:underline;" 
                               data-descripcion="{!! htmlspecialchars($recurso->descripcion, ENT_QUOTES, 'UTF-8') !!}">
                                Ver descripción
                            </a>
                        @endif
                    </td>
                    <td class="text-truncate" style="max-width: 150px;">
                        @if ($recurso->url != null)
                            <a href="https://{{ $recurso->url }}" target="_blank">Ver página</a>
                        @endif
                        @if ($recurso->archivo != null)
                            <a href="{{ asset($recurso->archivo) }}" target="_blank">Ver PDF</a>
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

<!-- Modal Descripción -->
<div class="modal fade" id="descripcionModal" tabindex="-1" aria-labelledby="descripcionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="descripcionModalLabel">Descripción del recurso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body" id="descripcionModalBody">
                <!-- Aquí se mostrará la descripción -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    $('.ver-descripcion').on('click', function () {
        var descripcion = $(this).data('descripcion');
        $('#descripcionModalBody').html(descripcion);
        var modal = new bootstrap.Modal(document.getElementById('descripcionModal'));
        modal.show();
    });
});
</script>

@endsection
