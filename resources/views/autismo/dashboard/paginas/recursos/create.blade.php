@extends ('autismo.dashboard.index')

@section ('title')

<title>Dashboard Autismo Región de Murcia - Crear recurso</title>

<script>

    function confirmCreate() {
        return confirm('¿Estás seguro de que quieres crear este recurso?');
    }

    function confirmReset() {
        return confirm('¿Estás seguro de que quieres resetear el formulario?');
    }

    function confirmVolver() {
        return confirm('¿Estás seguro de que quieres volver?');
    }

</script>

@endsection

@section ('content')

<div class="row">
    <div class="col-12">
        <h1 class="text-center">Crear recurso</h1>
    </div>
</div>
<br>
<div class="row">
    <div class="col-3"></div>
    <div class="col-6">
        <form action="{{ route('dashboard.recursos.store') }}" method="POST" enctype="multipart/form-data" onreset="return confirmReset()" onsubmit="return confirmCreate()">
            @csrf
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <br>
            <div class="form-group">
                <label for="tipo">Tipo</label>
                <div class="text-center" id="tipo">
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="tipo" id="urlTipo" value="urlTipo" checked>
                        <label class="form-check-label" for="urlTipo">
                            URL
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="tipo" id="archivoTipo" value="archivoTipo">
                        <label class="form-check-label" for="archivoTipo">
                            Archivo
                        </label>
                    </div>
                </div>
            </div>
            <br>
            <div class="form-group" style="display: block;" id="urlDiv">
                <label for="url">URL</label>
                <input type="text" class="form-control" id="url" name="url" required>
            </div>
            <div class="form-group" style="display: none;" id="archivoDiv">
                <label for="archivo">Archivo</label>
                <input type="file" class="form-control" id="archivo" name="archivo">
            </div>
            <br>
            <div class="form-group">
                <label for="etiquetas">Etiquetas</label>
                <div class="text-center" id="etiquetas">
                    @foreach ($etiquetas as $etiqueta)
                        <div class="form-check-inline">
                            <input class="form-check-input" type="checkbox" name="etiquetas[]" id="etiqueta{{ $etiqueta->id }}" value="{{ $etiqueta->id }}">
                            <label class="form-check-label" for="etiqueta{{ $etiqueta->id }}">
                                {{ $etiqueta->nombre }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            <br>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-submit">Crear</button>
                <button type="reset" class="btn btn-danger">Resetear</button>
                <a href="{{ route('dashboard.recursos') }}" class="btn btn-secondary" onclick="return confirmVolver()">Volver</a>
            </div>
        </form>
    </div>
    <div class="col-3"></div>
</div>

<script>

    $(document).ready(function() {
        $('input[type=radio][name=tipo]').change(function() {
            if (this.value === 'urlTipo') {
                $('#urlDiv').show().find('input').prop('required', true);
                $('#archivoDiv').hide().find('input').prop('required', false);
            } else if (this.value === 'archivoTipo') {
                $('#urlDiv').hide().find('input').prop('required', false);
                $('#archivoDiv').show().find('input').prop('required', true);
            }
        });

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

@endsection
