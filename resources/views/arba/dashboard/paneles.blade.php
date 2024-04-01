@extends('arba.dashboard')

@section('title')

<title>ARBA - Dashboard</title>

@stop

@section('content')
    <div class="row">
        <div class="row">
            <div class="col-12">
                <h1>Paneles</h1>
            </div>
        </div>
        <!-- TODO: Crear un panel que lleve a realizar la acción del controlador SocioController llamado getCreate -->
        <div class="row col-12 col-sm-6 col-md-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Crear socio</h2>
                    </div>
                    <div class="card-body">
                        <p>Crear un nuevo socio.</p>
                        <a href="{{ action([\App\Http\Controllers\SocioController::class, 'getCreate']) }}" class="btn btn-primary">Crear socio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
