@extends ('arba.dashboard')

@section ('title')

    <title>ARBA - Crear stock</title>

    <script>
            
        function confirmCrear() {
            return confirm('¿Estás seguro de que quieres crear este stock?');
        }

        function confirmReset() {
            return confirm('¿Estás seguro de que quieres limpiar los campos?');
        }

        function confirmVolver() {
            return confirm('¿Estás seguro de que quieres volver a la lista de stock?');
        }

    </script>

@stop

@section ('content')

    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Crear Stock</h1>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12 col-lg-4">

        </div>
        <div class="col-12">
            <form action="{{ route('arba.stock.create') }}" method="POST" class="container my-5 col-12 col-lg-4" onsubmit="return confirmCrear()" onreset="return confirmReset()">
                @csrf
                <div class="form-group">
                    <label for="planta">Planta</label>
                    <select name="planta" id="planta" class="form-select">
                        <option value="">Selecciona una planta</option>
                        @foreach ($plantas as $planta)
                            <option value="{{ $planta->id }}">{{ $planta->nombre_comun }} ({{ $planta->nombre_cientifico }})</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <label for="lugar">Lugar</label>
                    <select name="lugar" id="lugar" class="form-select">
                        <option value="">Selecciona un lugar</option>
                        @foreach ($lugares as $lugar)
                            <option value="{{ $lugar->id }}">{{ $lugar->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <label for="ubicacion">Ubicación</label>
                    <select name="ubicacion" id="ubicacion" class="form-select">
                        <option value="">Selecciona una ubicación</option>
                        @foreach ($ubicaciones as $ubicacion)
                            <option value="{{ $ubicacion->id }}">{{ $ubicacion->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <label for="contenedor">Contenedor</label>
                    <select name="contenedor" id="contenedor" class="form-select">
                        <option value="">Selecciona un contenedor</option>
                        @foreach ($contenedores as $contenedor)
                            <option value="{{ $contenedor->id }}">{{ $contenedor->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <label for="fecha_planta">Fecha de plantación</label>
                    <input type="date" name="fecha_planta" id="fecha_planta" class="form-control">
                </div>
                <br>
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" name="stock" id="stock" class="form-control">
                </div>
                <br>
                <div class="d-flex justify-content-evenly">
                    <button type="submit" class="btn btn-primary">Crear Stock</button>
                    <button type="reset" class="btn btn-danger">Limpiar</button>
                    <a href="{{ route('arba.stock') }}" onclick="return confirmVolver()" class="btn btn-secondary">Volver</a>
                </div>
            </form>
            <div class="col-12 col-lg-4">

            </div>
        </div>
    </div>

@stop