@extends ('arba.dashboard')

@section ('title')

    <title>ARBA - Crear Proyectos</title>
    <style>

        .ck-editor__editable_inline {
            min-height: 400px;
        }

    </style>
    <script src="{{ asset('assets/ckeditor5/build/ckeditor.js') }}"></script>
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
        function confirmReset() {
            return confirm('¿Estás seguro de que quieres resetear el formulario?');
        }
        function confirmCreate() {
            return confirm('¿Estás seguro de que quieres crear este proyecto?');
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
            <form action="{{ route('arba.proyecto.create') }}" method="POST" enctype="multipart/form-data" onsubmit="return confirmCreate()" onreset="return confirmReset()">
                @csrf
                <div class="form-group mb-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div> 
                <br>
                <div class="form-group mb-3">
                    <label for="logo">Logo</label>
                    <input type="file" class="form-control" id="logo" name="logo" accept="image/*" onchange="previewImage(event, '#logo-preview')" required>
                    <br>
                    <img class="img-fluid" id="logo-preview" width="200">
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="ubicacion">Ubicación</label>
                    <input type="text" class="form-control" id="ubicacion" name="ubicacion" required>
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="coordenadas">Coordenadas</label>
                    <input type="text" class="form-control" id="coordenadas" name="coordenadas" required>
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="20"></textarea>
                </div>
                <br>
                <div class="d-flex justify-content-around">
                    <button type="submit" class="btn btn-primary">Crear</button>
                    <button type="reset" class="btn btn-danger">Resetear</button>
                    <a href="{{ route('arba.proyecto') }}" class="btn btn-secondary" onclick="return confirmVolver()">Volver</a>
                </div>
            </form>
        </div>
        <div class="col-12 col-md-4"></div>
    </div>
</div>
<script>
    ClassicEditor
        .create(document.querySelector('#descripcion'))
        .catch(error => {
            console.error(error);
        });
</script>

@stop