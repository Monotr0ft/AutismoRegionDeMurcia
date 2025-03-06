@extends ('autismo.dashboard.index')

@section ('title')

    <title>Dashboard Autismo Región de Murcia - Usuarios</title>
    <style>
        .permiso-col {
            transition: opacity 0.3s ease, width 0.3s ease;
            overflow: hidden;
        }
    </style>
    <script>

        function confirmDelete() {
            return confirm('¿Estás seguro de que quieres eliminar este usuario?');
        }

    </script>

@stop

@section ('content')

<div class="row">
    <div class="col-12">
        <h1 class="text-center">Usuarios</h1>
    </div>
</div>
<br>
<div class="text-center">
    <a href="{{ route('dashboard.usuarios.create') }}" class="btn btn-success">Crear nuevo usuario</a>
</div>
<br>
<div class="row">
    <div class="col-12 table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th class="d-none d-lg-table-cell">Email</th>
                    <th class="d-none d-lg-table-cell">¿Está verificado?</th>
                    @if (Auth::user()->esJefe())
                    <th>Administrador</th>
                    @endif
                    <th>Gestor asociaciones</th>
                    <th>Gestor noticias</th>
                    <th>Gestor páginas</th>
                    <th>Gestor recursos</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    @if (Auth::user()->esAdministrador() && $usuario->esAdministrador())
                        @continue
                    @endif
                    @if (Auth::user()->esAdministrador() && $usuario->esJefe())
                        @continue
                    @endif
                    <tr>
                        <td>{{ $usuario->name }}</td>
                        <td class="d-none d-lg-table-cell">{{ substr($usuario->email, 0, 1) . '***' . substr($usuario->email, strpos($usuario->email, '@') - 1, 1) . strstr($usuario->email, '@') }}</td>
                        <td class="d-none d-lg-table-cell">{{ $usuario->email_verified_at ? 'Sí' : 'No' }}</td>
                        @if (Auth::user()->esJefe())
                        <td class="admin-col">
                            @if (!$usuario->esJefe())
                                <input type="checkbox" class="admin-checkbox" data-id="{{ $usuario->id }}" {{ $usuario->esAdministrador() ? 'checked' : '' }}>
                            @endif
                        </td>
                        @endif
                        <td class="permiso-col asociaciones-col">
                            @if (!$usuario->esJefe())
                                <input type="checkbox" class="asociaciones-checkbox" data-id="{{ $usuario->id }}" {{ $usuario->puedeGestionarAsociaciones() ? 'checked' : '' }}>
                            @endif
                        </td>
                        <td class="permiso-col noticias-col">
                            @if (!$usuario->esJefe())
                                <input type="checkbox" class="noticias-checkbox" data-id="{{ $usuario->id }}" {{ $usuario->puedeGestionarNoticias() ? 'checked' : '' }}>
                            @endif
                        </td>
                        <td class="permiso-col paginas-col">
                            @if (!$usuario->esJefe())
                                <input type="checkbox" class="paginas-checkbox" data-id="{{ $usuario->id }}" {{ $usuario->puedeGestionarPaginas() ? 'checked' : '' }}>
                            @endif
                        </td>
                        <td class="permiso-col recursos-col">
                            @if (!$usuario->esJefe())
                                <input type="checkbox" class="recursos-checkbox" data-id="{{ $usuario->id }}" {{ $usuario->puedeGestionarRecursos() ? 'checked' : '' }}>
                            @endif
                        </td>
                        <td>
                            <a href="" class="btn btn-warning">Editar</a>
                            <form action="" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirmDelete()">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Función para ocultar/mostrar solo los checkboxes
        function togglePermissionCheckboxes(checkbox) {
            const row = $(checkbox).closest('tr');
            const isAdmin = $(checkbox).is(':checked');
            
            row.find('.permiso-col input[type="checkbox"]').each(function() {
                $(this).toggle(!isAdmin);
            });
        }

        // Inicializar estado al cargar
        $('.admin-checkbox').each(function() {
            togglePermissionCheckboxes(this);
        });

        // Manejar cambios
        $('.admin-checkbox').change(function() {
            const checkbox = this;
            const originalState = $(checkbox).is(':checked');
            
            $.ajax({
                url: '{{ route("usuarios.updatePermission") }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                data: JSON.stringify({
                    user_id: $(checkbox).data('id'),
                    type: 'admin',
                    status: originalState
                }),
                contentType: 'application/json',
                success: function(data) {
                    if (!data.success) {
                        $(checkbox).prop('checked', !originalState);
                        alert('Error al actualizar el permiso');
                    }
                    togglePermissionCheckboxes(checkbox);
                },
                error: function(xhr) {
                    $(checkbox).prop('checked', !originalState);
                    alert('Error en la comunicación con el servidor');
                    console.error('Error:', xhr.responseText);
                    togglePermissionCheckboxes(checkbox);
                }
            });
        });

        $('.asociaciones-checkbox, .noticias-checkbox, .paginas-checkbox, .recursos-checkbox').change(function() {
            const checkbox = this;
            const originalState = $(checkbox).is(':checked');
            const type = $(checkbox).attr('class').split('-')[0];

            $.ajax({
                url: '{{ route("usuarios.updatePermission") }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                data: JSON.stringify({
                    user_id: $(checkbox).data('id'),
                    type: type,
                    status: originalState
                }),
                contentType: 'application/json',
                success: function(data) {
                    if (!data.success) {
                        $(checkbox).prop('checked', !originalState);
                        alert('Error al actualizar el permiso');
                    }
                },
                error: function(xhr) {
                    $(checkbox).prop('checked', !originalState);
                    alert('Error en la comunicación con el servidor');
                    console.error('Error:', xhr.responseText);
                }
            });
        });
    });
</script>
@stop