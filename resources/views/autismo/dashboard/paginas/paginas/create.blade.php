@extends ('autismo.dashboard.index')

@section ('title')

    <title>Dashboard Autismo Región de Murcia - Crear Página</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('/assets/ckeditor5/build/ckeditor.js') }}"></script>
    <style>

        .ck-editor__editable_inline {
            min-height: 1400px;
        }

    </style>
    <script>

        function confirmCreate() {
            return confirm('¿Estás seguro de que quieres crear esta página?');
        }

        function confirmVolver() {
            return confirm('¿Estás seguro de que quieres volver a la página anterior?');
        }

        function confirmReset() {
            return confirm('¿Estás seguro de que quieres resetear los campos?');
        }

    </script>

@stop

@section ('content')

<div class="row">
    <div class="col-12">
        <h1 class="text-center">Crear Página</h1>
    </div>
</div>
<br>
<form action="{{ route('dashboard.paginas.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12 col-md-3"></div>
        <div class="form-group col-12 col-md-6">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" required>
        </div>
        <div class="col-12 col-md-3"></div>
    </div>
    <br>
    <div style="margin-bottom: 10px; text-align: center;">
        <!-- Botones de vista previa de tamaño de pantalla con `type="button"` -->
        <button type="button" onclick="setEditorWidth('desktop')">Escritorio</button>
        <button type="button" onclick="setEditorWidth('tablet')">Tableta</button>
        <button type="button" onclick="setEditorWidth('mobile')">Móvil</button>
    </div>
    <br>
    <div class="form-group" id="editor-container" style="max-width: 100%; border: 1px solid #ccc; padding: 5px;">
        <label for="contenido">Contenido</label>
        <textarea class="form-control" id="contenido" name="contenido"></textarea>
    </div>
    <br>
    <div class="d-flex justify-content-around align-items-center">
        <button type="submit" class="btn btn-submit">Crear</button>
        <button type="reset" class="btn btn-warning">Resetear</button>
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
        cursor: move; /* Indicador de que la imagen es movible */
        position: relative; /* Cambiar a relative para que fluyan con el texto */
        max-width: 100%; /* Mantener la imagen responsiva */
    }
</style>

<script>
    // Función para ajustar el ancho del editor y centrarlo
    function setEditorWidth(view) {
        const editorContainer = document.getElementById('editor-container');
        
        if (view === 'desktop') {
            editorContainer.style.maxWidth = '100%'; // Ancho completo para escritorio
        } else if (view === 'tablet') {
            editorContainer.style.maxWidth = '768px'; // Tamaño típico de tableta
        } else if (view === 'mobile') {
            editorContainer.style.maxWidth = '375px'; // Tamaño típico de móvil
        }
        editorContainer.style.margin = '0 auto'; // Centrar el contenedor
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
            }
        })
        .then(editor => {
            const editorContainer = editor.ui.view.editable.element;

            // Habilitar arrastrar y soltar para las imágenes
            editorContainer.addEventListener('mousedown', (event) => {
                if (event.target.tagName === 'IMG') {
                    const img = event.target;

                    // Guardar la posición inicial del cursor y la imagen
                    const initialMouseX = event.clientX;
                    const initialMouseY = event.clientY;
                    const initialImgX = img.offsetLeft;
                    const initialImgY = img.offsetTop;

                    // Mover la imagen siguiendo el cursor
                    const onMouseMove = (moveEvent) => {
                        const deltaX = moveEvent.clientX - initialMouseX;
                        const deltaY = moveEvent.clientY - initialMouseY;
                        img.style.left = `${initialImgX + deltaX}px`;
                        img.style.top = `${initialImgY + deltaY}px`;
                        img.style.position = 'absolute'; // Asegura que se pueda mover libremente
                    };

                    // Asignar los eventos para mover y soltar la imagen
                    document.addEventListener('mousemove', onMouseMove);
                    document.addEventListener('mouseup', () => {
                        document.removeEventListener('mousemove', onMouseMove);
                    }, { once: true });
                }
            });
        })
        .catch(error => {
            console.error(error);
        });
</script>
@stop