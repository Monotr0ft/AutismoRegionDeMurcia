@extends ('arba.dashboard')

@section ('title')

    <title>ARBA - Stock</title>

@stop

@section ('content')

    <div class="row">
        <div class="col-12 col-lg-3"></div>
        <div class="col-12 col-lg-6">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center">Stock</h1>
                </div>
                <div class="d-flex justify-content-center col-12">
                    <a href="{{ action([\App\Http\Controllers\StockPlantaController::class, 'getEdit'], $stock_planta->id) }}" class="btn btn-warning m-2">Editar Stock</a>
                    <a href="{{ route('arba.stock') }}" class="btn btn-secondary m-2">Volver a Stock</a>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center">Datos del Stock</h2>
                </div>
                <div class="col-12 col-md-6 text-center">
                    <p><strong>Planta:</strong> {{ $stock_planta->planta->nombre_comun }} ({{ $stock_planta->planta->nombre_cientifico }})</p>
                    <p><strong>Contenedor:</strong> {{ $stock_planta->contenedor->nombre }}</p>
                    <p><strong>Savia:</strong> {{ $stock_planta->savia }}</p> 
                </div>
                <div class="col-12 col-md-6 text-center">
                    <p><strong>Lugar:</strong> {{ $stock_planta->lugar->nombre }}</p>
                    <p><strong>Ubicación:</strong> {{ $stock_planta->ubicacion->nombre }}</p>
                    <p><strong>Stock:</strong> {{ $stock_planta->stock }}</p>          
                </div>
                <div class="col-12 text-center">
                    <p><strong>Fecha de Plantación:</strong> {{ $stock_planta->fecha_planta }}</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3"></div>
    </div>

@stop