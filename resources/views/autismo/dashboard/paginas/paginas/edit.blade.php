@extends ('autismo.dashboard.index')

@section ('title')

    <title>Dashboard Autismo Región de Murcia - Editar Página {{ $pagina->titulo }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('/assets/ckeditor5/build/ckeditor.js') }}"></script>
    <style>

        .ck-editor__editable_inline {
            min-height: 1400px;
        }

    </style>
    <script>

        function confirmEdit() {
            return confirm('¿Estás seguro de que quieres editar esta página?');
        }

        function confirmVolver() {
            return confirm('¿Estás seguro de que quieres volver a la página anterior?');
        }

    </script>

@stop

@section ('content')

<div class="row">
    <div class="col-12">
        <h1 class="text-center">Editar Página {{ $pagina->titulo }}</h1>
    </div>
</div>
<br>
<form action="{{ route('dashboard.paginas.edit', $pagina->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-12 col-md-3"></div>
        <div class="form-group col-12 col-md-6">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $pagina->titulo }}" required>
        </div>
        <div class="col-12 col-md-3"></div>
    </div>
    <br>
    <div class="form-group">
        <label for="contenido">Contenido</label>
        <textarea class="form-control" id="contenido" name="contenido">
            {!! $pagina->contenido !!}
        </textarea>
    </div>
    <br>
    <div class="d-flex justify-content-around align-items-center">
        <button type="submit" class="btn btn-warning">Editar</button>
        <a href="{{ route('dashboard.paginas') }}" class="btn btn-secondary" onclick="return confirmVolver()">Volver</a>
    </div>
</form>
<script>
    let images = [];

    ClassicEditor
        .create(document.querySelector('#contenido'), {
            simpleUpload: {
                uploadUrl: '{{ route('upload') }}',
                withCredentials: true,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                }
            },
            image: {
                toolbar: [
                    'imageTextAlternative', // Para agregar texto alternativo a las imágenes
                    'imageStyle:full', // Para imágenes de tamaño completo
                    'imageStyle:side', // Para imágenes alineadas a los lados
                    'imageStyle:alignLeft', // Para alinear la imagen a la izquierda
                    'imageStyle:alignCenter', // Para alinear la imagen al centro
                    'imageStyle:alignRight', // Para alinear la imagen a la derecha
                    'linkImage', // Para agregar un enlace a la imagen
                    'imageResize', // Para cambiar el tamaño de la imagen
                    'imageInsert', // Para insertar una imagen
                ],
                styles: [
                    'full',
                    'side',
                    'alignLeft',
                    'alignCenter',
                    'alignRight',
                ]
            },
        })
        .catch(error => {
            console.error(error);
        });
</script>
@stop