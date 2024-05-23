@extends ('arba.dashboard')

@section ('title')

    <title>ARBA - Editar Proyecto {{ $proyecto->nombre }}</title>
    <script>
        function previewImage(event, querySelector) {
            const input = event.target;
            $imgPreview = document.querySelector(querySelector);
            if (!input.files.length) {
                return;
            }
            file = input.files[0];
            objectURL = URL.createObjectURL(file);
            $imgPreview.src = objectURL;
        }
        function confirmUpdate() {
            return confirm('¿Estás seguro de que quieres actualizar este proyecto?');
        }
        function confirmVolver() {
            return confirm('¿Estás seguro de que quieres volver a la lista de proyectos?');
        }
    </script>

@stop

@section ('content')

<div class="row">
    <div class="col-12">
        <h1 class="text-center">Crear Proyecto</h1>
    </div>
    <div class="row">
        <div class="col-12 col-md-4"></div>
        <div class="col-12 col-md-4">
            <form action="{{ route('arba.proyecto.edit', $proyecto->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirmUpdate()">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $proyecto->nombre }}" required>
                </div> 
                <br>
                <div class="form-group mb-3">
                    <label for="logo">Logo</label>
                    <input type="file" class="form-control" id="logo" name="logo" accept="image/*" onchange="previewImage(event, '#logo-preview')">
                    <br>
                    <img class="img-fluid" id="logo-preview" width="200">
                    <br>
                    <img class="img-fluid" width="200" src="{{ asset($proyecto->logo) }}" alt="{{ $proyecto->nombre }}">
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="ubicacion">Ubicación</label>
                    <input type="text" class="form-control" id="ubicacion" name="ubicacion" value="{{ $proyecto->ubicacion }}" required>
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="coordenadas">Coordenadas</label>
                    <input type="text" class="form-control" id="coordenadas" name="coordenadas" value="{{ $proyecto->coordenadas }}" required>
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="20" required>{{ $proyecto->descripcion }}</textarea>
                </div>
                <br>
                <div class="d-flex justify-content-around">
                    <button type="submit" class="btn btn-warning">Editar</button>
                    <a href="{{ route('arba.proyecto') }}" class="btn btn-secondary" onclick="return confirmVolver()">Volver</a>
                </div>
            </form>
        </div>
        <div class="col-12 col-md-4"></div>
    </div>
</div>

@stop
