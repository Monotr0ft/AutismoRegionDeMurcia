@extends ('arba.dashboard')

@section ('title')

    <title>ARBA - Stock</title>

    <script>
            
        function confirmEliminar() {
            return confirm('¿Estás seguro de que quieres eliminar este stock?');
        }

    </script>

@stop

@section ('content')

    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Stock</h1>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12">
            <a href="{{ action([\App\Http\Controllers\StockPlantaController::class, 'getCreate']) }}" class="btn btn-primary">Crear Stock</a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Planta</th>
                        <th class="d-none d-md-table-cell">Lugar</th>
                        <th>Ubicación</th>
                        <th class="d-none d-md-table-cell">Contenedor</th>
                        <th class="d-none d-md-table-cell">Fecha plantación</th>
                        <th class="d-none d-md-table-cell">Savia</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stock_plantas as $stock_planta)
                        <tr>
                            <td>{{ $stock_planta->planta->nombre_comun }} ({{ $stock_planta->planta->nombre_cientifico }})</td>
                            <td class="d-none d-md-table-cell">{{ $stock_planta->lugar->nombre }}</td>
                            <td>{{ $stock_planta->ubicacion->nombre }}</td>
                            <td class="d-none d-md-table-cell">{{ $stock_planta->contenedor->nombre }}</td>
                            <td class="d-none d-md-table-cell">{{ $stock_planta->fecha_planta }}</td>
                            <td class="d-none d-md-table-cell">{{ $stock_planta->savia }}</td>
                            <td>{{ $stock_planta->stock }}</td>
                            <td>
                                <a href="{{ route('arba.stock.show', $stock_planta->id) }}" class="btn btn-primary">Ver</a>
                                <a href="{{ action([\App\Http\Controllers\StockPlantaController::class, 'getEdit'], $stock_planta->id) }}" class="btn btn-warning">Editar</a>
                                <form action="{{ route('arba.stock.delete', $stock_planta->id) }}" method="POST" class="d-inline" onsubmit="return confirmEliminar()">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop