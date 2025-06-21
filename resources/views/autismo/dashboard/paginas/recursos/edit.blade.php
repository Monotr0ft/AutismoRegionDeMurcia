@extends ('autismo.dashboard.index')

@section ('title')

<title>Dashboard Autismo Región de Murcia - Editar recurso {{ $recurso->titulo }}</title>

<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    
    function confirmEdit() {
        return confirm('¿Estás seguro de que quieres editar este recurso?');
    }

    function confirmVolver() {
        return confirm('¿Estás seguro de que quieres volver?');
    }

</script>

@include('ckeditor.css')

@endsection

@section ('content')

<div class="row">
    <div class="col-12">
        <h1 class="text-center">Editar recurso {{ $recurso->titulo }}</h1>
    </div>
</div>
<br>
<div class="row">
    <div class="col-3"></div>
    <div class="col-6">
        <form action="{{ route('dashboard.recursos.update', $recurso->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirmEdit()">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $recurso->titulo }}" required>
            </div>
            <br>
            <div class="form-group">
                <label for="editor">Descripción</label>
                <textarea class="form-control" id="editor" name="descripcion" rows="3" required>{{ $recurso->descripcion }}</textarea>
            </div>
            <br>
            <div class="form-group" id="urlDiv">
                <label for="url">URL</label>
                <input type="text" class="form-control" id="url" name="url" value="{{ $recurso->url }}">
            </div>
            <div class="form-group" id="archivoDiv">
                <label for="archivo">Archivo</label>
                <input type="file" class="form-control" id="archivo" name="archivo" value="{{ $recurso->archivo }}">
            </div>
            <br>
            <div class="form-group">
                <label for="etiquetas">Etiquetas</label>
                <div class="text-center" id="etiquetas">
                    @foreach ($etiquetas as $etiqueta)
                        <div class="form-check-inline">
                            <input class="form-check-input" type="checkbox" name="etiquetas[]" id="etiqueta{{ $etiqueta->id }}" value="{{ $etiqueta->id }}" @if ($recurso->etiquetas->contains($etiqueta->id)) checked @endif>
                            <label class="form-check-label" for="etiqueta{{ $etiqueta->id }}">
                                {{ $etiqueta->nombre }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            <br>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-submit">Editar</button>
                <a href="{{ route('dashboard.recursos') }}" class="btn btn-secondary" onclick="return confirmVolver()">Volver</a>
            </div>
        </form>
    </div>
    <div class="col-3"></div>
</div>

<script>
    
    $(document).ready(function() {

        $('#archivo').change(function() {
            var archivo = $('#archivo').val();
            var extension = archivo.split('.').pop().toLowerCase();
            if (extension !== 'pdf') {
                alert('El archivo debe ser un PDF');
                $('#archivo').val('');
            }
        })
    });

</script>
<script>
    const uploadUrl = "{{ route('upload') }}";
</script>
@include('ckeditor.script')

@endsection
