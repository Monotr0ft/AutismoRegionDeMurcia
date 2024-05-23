@extends ('arba.dashboard')

@section ('title')

    <title>ARBA - Dashboard Administración</title>

@stop

@section ('content')

<div class="row">
    <div class="row">
        <div class="col-12">
            <h1>Administración</h1>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        <div class="col d-flex align-items-stretch">
            <div class="card" style="width: 100%">
                <div class="card-header">
                    <h2>Socios</h2>
                </div>
                <div class="card-body">
                    <p>Aquí se puede ver todos los socios registrados</p>
                    <a href="{{ route('arba.socio') }}" class="btn btn-primary">Entra aquí</a>
                </div>
            </div>
        </div>
        <div class="col d-flex align-items-stretch">
            <div class="card" style="width: 100%">
                <div class="card-header">
                    <h2>Proyectos</h2>
                </div>
                <div class="card-body">
                    <p>Aquí se puede ver todos los proyectos</p>
                    <a href="{{ route('arba.proyecto') }}" class="btn btn-primary">Entra aquí</a>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
