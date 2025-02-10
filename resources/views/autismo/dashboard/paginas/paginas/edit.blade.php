@extends ('autismo.dashboard.index')

@section ('title')

    <title>Dashboard Autismo Región de Murcia - Editar Página {{ $pagina->titulo }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .ck-editor__editable_inline {
            min-height: 1400px;
        }
        .ck-content {
            background-color: transparent; 
            color: #000000;
        }
    </style>
    @include ('ckeditor.css')
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
<form action="{{ route('dashboard.paginas.edit', $pagina->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirmEdit()">
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
        <label for="editor">Contenido</label>
        <textarea class="form-control" id="editor" name="contenido">
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

</script>
<script>
    const uploadUrl = "{{ route('upload') }}";
</script>
@include ('ckeditor.script')
@stop