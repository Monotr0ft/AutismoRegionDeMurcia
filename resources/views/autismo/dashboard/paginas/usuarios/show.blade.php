@extends ('autismo.dashboard.index')

@section('title')

    <title>Dashboard Autismo Región de Murcia - Panel de Usuario</title>

@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <h1 class="text-center">Panel de Usuario</h1>
    </div>
</div>
<br>
<div class="d-flex justify-content-center">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Información del Usuario
                    </div>
                    <div class="card-body">
                        <p><strong>Nombre:</strong> {{ $user->name }}</p>
                        <p><strong>Accesos:</strong></p>
                        <ul>
                            @if ($user->esJefe())
                                <li>Jefe</li>
                            @else
                                @if ($user->esAdministrador())
                                    <li>Administrador</li>
                                @else
                                    @if ($user->puedeGestionarAsociaciones())
                                        <li>Gestor de Asociaciones</li>
                                    @endif
                                    @if ($user->puedeGestionarNoticias())
                                        <li>Gestor de Noticias</li>
                                    @endif
                                    @if ($user->puedeGestionarPaginas())
                                        <li>Gestor de Páginas</li>
                                    @endif
                                    @if ($user->puedeGestionarRecursos())
                                        <li>Gestor de Recursos</li>
                                    @endif
                                @endif
                            @endif
                        </ul>
                        <p><strong>Email:</strong> {{ substr($user->email, 0, 1) . str_repeat('*', 3) . substr($user->email, strpos($user->email, '@') - 1) }}</p>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Cambiar Contraseña
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('panel.update.password') }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="current_password">Contraseña Actual</label>
                                <input type="password" class="form-control" id="current_password" name="current_password" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="new_password">Nueva Contraseña</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="new_password_confirmation">Confirmar Nueva Contraseña</label>
                                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-submit">Cambiar Contraseña</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Cambiar Información de Usuario
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('panel.update.name') }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Nombre de Usuario</label>
                                <input type="text" class="form-control" id="name" name="name" value="" required>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-submit">Actualizar Nombre de Usuario</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>

@endsection
