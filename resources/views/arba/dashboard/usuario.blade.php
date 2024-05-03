@extends ('arba.dashboard')

@section ('title')

<title>ARBA - Usuario</title>

@endsection

@section ('content')

<div class="row">
    <div class="col-12 col-lg-4"></div>
    <div class="row col-12 col-lg-4">
        <div class="col-12 row">
            @if ($errors->any())
                <h4 class="text-danger text-center p-4" style="background-color: whitesmoke; border-radius: 10px">{{ $errors->first() }}</h4>
            @endif
            <h1>Usuario</h1>
            <div class="col-12">
                <h2>Perfil</h2>
                <p><strong>Nombre de usuario:</strong> {{ $user->name }}</p>
                <p><strong>Correo electrónico:</strong> {{ $user->email }}</p>
                <p><strong>Fecha de creación:</strong> {{ $user->created_at }}</p>
                <p><strong>¿Está verificado?</strong> {{ $user->email_verified_at ? 'Sí' : 'No' }}</p>
            </div>
            <div class="col-12 col-lg-6">
                <h2 class="text-center">Cambiar contraseña</h2>
                <form method="POST" action="{{ route('arba.perfil.password') }}">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="password">Contraseña actual</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="new_password">Nueva contraseña</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="new_password_confirmation">Confirmar nueva contraseña</label>
                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Cambiar contraseña</button>
                </form>
            </div>
            <div class="col-12 col-lg-6 d-flex flex-column justify-content-center align-items-center">
                <h2>Verificar email</h2>
                @if (!$user->email_verified_at)
                    <form method="POST" action="">
                        @csrf
                        <button type="submit" class="btn btn-primary">Verificar email</button>
                    </form>
                @else
                    <p>El email ya está verificado.</p>
                @endif
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4"></div>
</div>

@endsection