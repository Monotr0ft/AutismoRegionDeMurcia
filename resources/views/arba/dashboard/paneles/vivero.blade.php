@extends ('arba.dashboard')

@section ('title')

    <title>ARBA - Dashboard Vivero</title>

@stop

@section ('content')

<div class="row">
    <div class="row">
        <div class="col-12">
            <h1>Vivero</h1>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        <div class="col d-flex align-items-stretch">
            <div class="card" style="width: 100%">
                <div class="card-header">
                    <h2>Stock</h2>
                </div>
                <div class="card-body">
                    <p>Desde aquí se puede llevar el stock</p>
                    <a href="{{ route('arba.stock') }}" class="btn btn-primary">Entra aquí</a>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
