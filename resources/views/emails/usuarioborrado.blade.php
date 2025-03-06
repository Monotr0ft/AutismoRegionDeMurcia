@extends ('emails.dashboard')

@section ('title')

    <title>Usuario borrado ARM</title>

@stop

@section ('content')

    <h1 style="font-size: 18px; font-weight: bold; margin-top: 0; color: #3d4852; text-align: left;">Usuario borrado de ARM</h1>

    <p style="font-size: 16px; line-height: 1.5; text-align: left;">Hola jefe,</p>

    <p style="font-size: 16px; line-height: 1.5; text-align: left;">El usuario {{ $user->name }} ({{ $user->email }}) ha sido eliminado de la base de datos de ARM.</p>

    <p style="font-size: 16px; line-height: 1.5; text-align: left;">Esta ha sido la razón del borrado de su cuenta</p>

    <div style="border: 1px solid #ddd; padding: 10px 10px 5px 10px; background-color: #f9f9f9; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1); border-radius: 10px; width: 35%; margin: 0 auto 20px auto; text-align: center;">
        <p style="margin: 0;">{{ $razon }}</p>
    </div>

@stop

@section ('footer')
    
    <p style="font-size: 14px; line-height: 1.5; text-align: center; color: #6c757d;">
        Si la razón no te parece justa, se te deja la información del administrador responsable de la eliminación: {{ $admin->name }} ({{ $admin->email }}).
    </p>

@stop