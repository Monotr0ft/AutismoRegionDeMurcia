@extends('arba.dashboard')

@section('title')

<title>ARBA - Dashboard</title>

@stop

@section('content')
    <div class="row">
        <div class="row">
            <div class="col-12">
                @php
                    $user = Auth::guard('arba')->user();
                    $socio = \App\Models\Socio::where('user_id', $user->id)->first();
                @endphp
                <h1>Paneles</h1>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            @if (!$socio || $socio->administracion == 1)
            <div class="col d-flex align-items-stretch">
                <div class="card" style="width: 100%">
                    <div class="card-header">
                        <h2>Administración</h2>
                    </div>
                    <div class="card-body">
                        <p>Aquí te permite manejar los socios, los proyectos y los usuarios de la web</p>
                        <a href="{{ route('arba.administracion') }}" class="btn btn-primary">Entra aquí</a>
                    </div>
                </div>
            </div>
            @endif
            @if (!$socio || $socio->vivero == 1)
            <div class="col d-flex align-items-stretch">
                <div class="card" style="width: 100%">
                    <div class="card-header">
                        <h2>Vivero</h2>
                    </div>
                    <div class="card-body">
                        <p>Desde aquí se puede llevar el stock y todos los datos del vivero</p>
                        <a href="{{ route('arba.vivero') }}" class="btn btn-primary">Entra aquí</a>
                    </div>
                </div>
            </div>
            @endif
            @if (!$socio || $socio->partes_trabajo == 1)
            <div class="col d-flex align-items-stretch">
                <div class="card" style="width: 100%">
                    <div class="card-header">
                        <h2>Partes de trabajo</h2>
                    </div>
                    <div class="card-body">
                        <p>Lorem ipsum dolor</p>
                        <a href="#" class="btn btn-primary">Entra aquí</a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@stop
