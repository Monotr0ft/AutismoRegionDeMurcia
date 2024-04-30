@extends ('arba.dashboard')

@section ('title')

    <title>ARBA - Editar Stock</title>

    <script>
            
        function confirmEditar() {
            return confirm('¿Estás seguro de que quieres editar este stock?');
        }

        function confirmVolver() {
            return confirm('¿Estás seguro de que quieres volver a la lista de stock?');
        }

    </script>

@stop

@section ('content')

    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Editar Stock</h1>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12 col-lg-4">

        </div>
        <div class="col-12">
            <form action="{{ route('arba.stock.edit', $stock_planta->id) }}" method="POST" class="container my-5 col-12 col-lg-4" onsubmit="return confirmEditar()">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="planta">Planta</label>
                    <select name="planta" id="planta" class="form-select">
                        <option value="">Selecciona una planta</option>
                        @foreach ($plantas as $planta)
                            <option value="{{ $planta->id }}" @if ($planta->id == $stock_planta->planta_id) selected @endif>{{ $planta->nombre_comun }} ({{ $planta->nombre_cientifico }})</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="lugar">Lugar</label>
                    <select name="lugar" id="lugar" class="form-select">
                        <option value="">Selecciona un lugar</option>
                        @foreach ($lugares as $lugar)
                            <option value="{{ $lugar->id }}" @if ($lugar->id == $stock_planta->lugar_id) selected @endif>{{ $lugar->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="ubicacion">Ubicación</label>
                    <select name="ubicacion" id="ubicacion" class="form-select">
                        <option value="">Selecciona una ubicación</option>
                        @foreach ($ubicaciones as $ubicacion)
                            <option value="{{ $ubicacion->id }}" @if ($ubicacion->id == $stock_planta->ubicacion_id) selected @endif>{{ $ubicacion->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="contenedor">Contenedor</label>
                    <select name="contenedor" id="contenedor" class="form-select">
                        <option value="">Selecciona un contenedor</option>
                        @foreach ($contenedores as $contenedor)
                            <option value="{{ $contenedor->id }}" @if ($contenedor->id == $stock_planta->contenedor_id) selected @endif>{{ $contenedor->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <label for="fecha_planta">Fecha de plantación</label>
                    <input type="date" name="fecha_planta" id="fecha_planta" class="form-control" value="{{ $stock_planta->fecha_planta }}">
                </div>
                <br>
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" name="stock" id="stock" class="form-control" value="{{ $stock_planta->stock }}">
                </div>
                <br>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-warning m-2">Editar Stock</button>
                    <a href="{{ route('arba.stock.show', $stock_planta->id) }}" class="btn btn-secondary m-2" onclick="return confirmVolver()">Volver</a>
                </div>
            </form>
        </div>
        <div class="col-12 col-lg-4">

        </div>
    </div>

@stop