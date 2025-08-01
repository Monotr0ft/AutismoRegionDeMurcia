@extends('autismo.dashboard.index')

@section('title')

    <title>Dashboard Autismo Región de Murcia - Asociaciones Nuevas</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .ck-editor__editable_inline {
            min-height: 400px;
        }

        .ck-content {
            background-color: transparent;
            color: #000000;
        }
    </style>
    @include('ckeditor.css')

@stop

@section('content')

<div>
    <div class="my-5 text-center">
        <h2>Editar {{ $asociacion->tipo }} {{ $asociacion->nombre }}</h2>
    </div>
    <div class="row">
        <div class="col-12 col-md-4"></div>
        <div class="col-12 col-md-4">
            <form action="{{ route('dashboard.asociacionesnuevas.edit', $asociacion->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirmEdit()">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $asociacion->nombre }}" required>
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="editor">Descripción</label>
                    <textarea class="form-control" id="editor" name="descripcion" rows="20" required>{{ $asociacion->descripcion }}</textarea>
                </div>
                <br>
                <h2>Direccion</h2>
                <br>
                <p>{{ $asociacion->direccion }}</p>
                <br>
                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="nueva_direccion" name="nueva_direccion" value="1">
                    <label for="nueva_direccion" class="form-check-label">¿Quieres cambiar la dirección?</label>
                </div>
                <br>
                <div id="direccion" class="mb-3" style="display: none;">
                    <div class="form-group">
                        <label for="provincia">Provincia</label>
                        <select class="form-select" name="provincia" id="provincia" required>
                            <option selected>Selecciona una provincia</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="municipio">Municipio</label>
                        <select class="form-select" name="municipio" id="municipio" required disabled>
                            <option selected>Selecciona un municipio</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="localidad">Localidad</label>
                        <select class="form-select" name="localidad" id="localidad" required disabled>
                            <option selected>Selecciona una localidad</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="tipo_calle">Tipo de calle</label>
                        <select class="form-select" name="tipo_calle" id="tipo_calle" required>
                            <option selected>Selecciona un tipo de calle</option>
                            <option value="Calle">Calle</option>
                            <option value="Avda">Avenida</option>
                            <option value="Travesia">Travesia</option>
                            <option value="Carretera">Carretera</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="nombre_calle">Nombre de la calle</label>
                        <input type="text" class="form-control" name="nombre_calle" id="nombre_calle" placeholder="Nombre de la calle" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="numero">Número</label>
                        <input type="text" class="form-control" name="numero" id="numero" placeholder="Número" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="ampliacion">Ampliación</label>
                        <input type="text" class="form-control" name="ampliacion" id="ampliacion" placeholder="Ampliación">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="codigo_postal">Código postal</label>
                        <input type="text" class="form-control" name="codigo_postal" id="codigo_postal" placeholder="Código postal" required>
                    </div>
                </div>
                <br>
                <h2>Datos Asociacion</h2>
                <div class="form-group mb-3">
                    <label for="tipo">Tipo</label>
                    <select class="form-select" id="tipo" name="tipo" required>
                        <option>Seleccione un tipo</option>
                        <option value="Asociación" @if ($asociacion->tipo == 'Asociación') selected @endif>Asociación</option>
                        <option value="Fundación" @if ($asociacion->tipo == 'Fundación') selected @endif>Fundación</option>
                    </select>
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="logo">Logo</label>
                    <input type="file" class="form-control" id="logo" name="logo" accept="image/*" onchange="previewImage(event, '#logoPreview')">
                    <br>
                    <img src="" alt="" class="img-fluid" id="logoPreview" style="height: 200px;">
                    <br>
                    <img src="{{ asset($asociacion->logo) }}" alt="{{ $asociacion->nombre }}" class="img-fluid" id="logoNow" style="height: 200px;">
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="telefono">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $asociacion->telefono }}">
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $asociacion->email }}">
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="web">Web</label>
                    <input type="text" class="form-control" id="web" name="web" value="{{ $asociacion->web }}">
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="redes_sociales">Redes Sociales</label>
                    <div id="redes_sociales">
                        @if ($asociacion->redes_sociales != null)
                            @foreach (json_decode($asociacion->redes_sociales) as $red_social)
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="redes_sociales[]" value="{{ $red_social }}">
                                    <button type="button" class="btn btn-danger" onclick="removeRedSocial(this)">Eliminar</button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <button type="button" class="btn btn-primary" onclick="addRedSocial()">Añadir Red Social</button>
                </div>
                <br>
                <div class="form-check mb-3">
                    @if ($asociacion->es_regional == 1)
                        <input type="checkbox" class="form-check-input" id="es_regional" name="es_regional" value="1" checked>
                    @else
                        <input type="checkbox" class="form-check-input" id="es_regional" name="es_regional" value="1">
                    @endif
                    <label for="es_regional" class="form-check-label">¿Es regional?</label>
                </div>
                <br>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-warning">Editar Asociación</button>
                    <a href="{{ route('dashboard.asociacionesnuevas') }}" class="btn btn-secondary" onclick="return confirmVolver()">Volver a Asociaciones</a>
                </div>
            </form>
        </div>
        <div class="col-12 col-md-4"></div>
    </div>
</div>
<script>
    function previewImage(event, querySelector) {
        const input = event.target;
        const $imgPreview = $(querySelector);
        if (!input.files.length) {
            return;
        }
        const file = input.files[0];
        const objectURL = URL.createObjectURL(file);
        $imgPreview.attr('src', objectURL).show();
    }   
    function addRedSocial() {
        const $redesSociales = $('#redes_sociales');
        const $div = $('<div>').addClass('input-group mb-3');
        $div.html(`
            <input type="text" class="form-control" name="redes_sociales[]">
            <div class="input-group-append">
                <button class="btn btn-danger" type="button" onclick="removeRedSocial(this)">-<button>
            </div>
        `);
        $redesSociales.append($div);
    }   
    function removeRedSocial(button) {
        $(button).closest('.input-group').remove();
    }   
    $(document).ready(function() {
        const $provinciaLista = $('#provincia');
        const $municipioLista = $('#municipio');
        const $localidadLista = $('#localidad');    
        $.getJSON('https://apiv1.geoapi.es/provincias?type=JSON&key=f830ac50cc0e6b1d1bd1081223bacdf1d8dce93a435988ee74e06b513245e2a2&CCOM=17', function(data) {
            data.data.forEach(function(provincia) {
                const nombreProvincia = provincia.PRO.toLowerCase().split(' ').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
                const $option = $('<option>').val(nombreProvincia).attr('id', provincia.CPRO).text(nombreProvincia);
                $provinciaLista.append($option);
            });
        }); 
        $provinciaLista.change(function() {
            const provinciaId = $provinciaLista.find('option:selected').attr('id');
            $.getJSON(`https://apiv1.geoapi.es/municipios?type=JSON&key=f830ac50cc0e6b1d1bd1081223bacdf1d8dce93a435988ee74e06b513245e2a2&CPRO=${provinciaId}`, function(data) {
                $municipioLista.prop('disabled', false).empty();
                const $defaultOption = $('<option>').prop('selected', true).prop('disabled', true).text('Selecciona un municipio');
                $municipioLista.append($defaultOption);
                data.data.forEach(function(municipio) {
                    const nombreMunicipio = municipio.DMUN50.split(/(\(.*?\))/).map((segment, index) => {
                        if (index % 2 === 0) {
                            return segment.toLowerCase().split(' ').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
                        } else {
                            return segment.charAt(0) + segment.charAt(1).toUpperCase() + segment.slice(2).toLowerCase();
                        }
                    }).join('');
                    const $option = $('<option>').val(nombreMunicipio).attr('id', municipio.CMUM).text(nombreMunicipio);
                    $municipioLista.append($option);
                });
            });
        }); 
        $municipioLista.change(function() {
            const provinciaId = $provinciaLista.find('option:selected').attr('id');
            const municipioId = $municipioLista.find('option:selected').attr('id');
            $.getJSON(`https://apiv1.geoapi.es/poblaciones?type=JSON&key=f830ac50cc0e6b1d1bd1081223bacdf1d8dce93a435988ee74e06b513245e2a2&CPRO=${provinciaId}&CMUM=${municipioId}`, function(data) {
                $localidadLista.prop('disabled', false).empty();
                const $defaultOption = $('<option>').prop('selected', true).prop('disabled', true).text('Selecciona una localidad');
                $localidadLista.append($defaultOption);
                data.data.forEach(function(localidad) {
                    const nombreLocalidad = localidad.NENTSI50.split(/(\(.*?\))/).map((segment, index) => {
                        if (index % 2 === 0) {
                            return segment.toLowerCase().split(' ').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
                        } else {
                            return segment.charAt(0) + segment.charAt(1).toUpperCase() + segment.slice(2).toLowerCase();
                        }
                    }).join('');
                    const $option = $('<option>').val(nombreLocalidad).text(nombreLocalidad);
                    $localidadLista.append($option);
                })
            });
        }); 
    }); 

    function toggleDireccion() {
        const $direccion = $('#direccion');
        const $nuevaDireccion = $('#nueva_direccion');
        if ($nuevaDireccion.is(':checked')) {
            $direccion.show();
            $nuevaDireccion.val(1);
        } else {
            $direccion.hide();
            $nuevaDireccion.val(0);
        }
    }
    $('#nueva_direccion').change(function() {
        toggleDireccion();
    });

    function confirmEdit() {
        return confirm('¿Estás seguro de que quieres editar esta asociación?');
    }   
    function confirmVolver() {
        return confirm('¿Estás seguro de que quieres volver a la lista de asociaciones nuevas?');
    }   
    </script>
<script>
    const uploadUrl = "{{ route('upload') }}";
</script>
@include('ckeditor.script')
@stop
