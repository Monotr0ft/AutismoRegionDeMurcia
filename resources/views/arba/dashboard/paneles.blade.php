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
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            <div class="col">
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
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h2>Vincular socio a usuario</h2>
                    </div>
                    <div class="card-body">
                        <p>Vincula un socio a un usuario que se creará en el proceso.</p>
                        <a href="#" class="btn btn-primary">Vincular socio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
