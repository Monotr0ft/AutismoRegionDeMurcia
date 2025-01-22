@extends ('autismo.dashboard.index')

@section ('title')

    <title>Dashboard Autismo Región de Murcia - Editar Página {{ $pagina->titulo }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('/assets/ckeditor5/build/ckeditor.js') }}"></script>
    <style>
        .ck-editor__editable_inline {
            min-height: 1400px;
        }
        .ck-content {
            background-color: transparent; 
            color: #000000;
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
    <div style="margin-bottom: 10px; text-align: center;">
        <!-- Botones de vista previa de tamaño de pantalla con `type="button"` -->
        <button type="button" onclick="setEditorWidth('desktop')">Escritorio</button>
        <button type="button" onclick="setEditorWidth('tablet')">Tableta</button>
        <button type="button" onclick="setEditorWidth('mobile')">Móvil</button>
    </div>
    <br>
    <div class="form-group" id="editor-container" style="max-width: 100%; border: 1px solid #ccc; padding: 5px;">
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
<style>
    /* Estilo adicional para los botones */
    button {
        padding: 8px 12px;
        margin: 5px;
        cursor: pointer;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
    }

    button:hover {
        background-color: #0056b3;
    }

    /* CSS para centrar el editor y hacer las imágenes movibles */
    #editor-container {
        margin: 0 auto; /* Centrando el editor */
    }

    .ck-content img {
        max-width: 100%; /* Mantener la imagen responsiva */
    }
</style>

<script>
    // Función para ajustar el ancho del editor y centrarlo
    function setEditorWidth(view) {
        const editorContainer = $('#editor-container');
        
        if (view === 'desktop') {
            editorContainer.css('max-width', '100%'); // Ancho completo para escritorio
        } else if (view === 'tablet') {
            editorContainer.css('max-width', '768px'); // Tamaño típico de tableta
        } else if (view === 'mobile') {
            editorContainer.css('max-width', '375px'); // Tamaño típico de móvil
        }
        editorContainer.css('margin', '0 auto'); // Centrar el contenedor
    }

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
            withCredentials: true,
            image: {
                toolbar: [
                    'imageTextAlternative',
                    'imageStyle:full',
                    'imageStyle:side',
                    'imageStyle:alignLeft',
                    'imageStyle:alignCenter',
                    'imageStyle:alignRight',
                    'linkImage',
                    'imageResize',
                    'imageInsert',
                ],
                styles: [
                    { name: 'full', className: 'img-fluid' },
                    { name: 'side', className: 'img-fluid float-start' },
                    { name: 'alignLeft', className: 'img-fluid float-start' },
                    { name: 'alignCenter', className: 'img-fluid mx-auto d-block' },
                    { name: 'alignRight', className: 'img-fluid float-end' }
                ]
            },
            mediaEmbed: {
                previewsInData: true
            },
        })
        .then(editor => {
            window.editor = editor;
        })
        .catch(error => {
            console.error(error);
        });
</script>
@stop