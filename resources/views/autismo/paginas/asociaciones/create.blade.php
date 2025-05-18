@extends('autismo.index')

@section('title')
<title>Autismo Región de Murcia - Crear Asociación</title>
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
        <h2>Crear Asociación</h2>
    </div>
    <div class="row">
        <div class="col-12 col-md-4"></div>
        <div class="col-12 col-md-4">
            @if ($errors->any() && !$errors->has('newsletter_error'))
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    @if ($error != 'newsletter_error')
                        <li>{{ $error }}</li>
                    @endif
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{ route('asociaciones.store') }}" method="POST" enctype="multipart/form-data" id="asociacionForm">
                @csrf
                <div class="form-group mb-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="editor">Descripción</label>
                    <textarea class="form-control" id="editor" name="descripcion"></textarea>
                </div>
                <br>
                <div id="direccion" class="mb-3">
                    <h2>Dirección</h2>
                    <div class="form-group">
                        <label for="provincia">Provincia</label>
                        <select class="form-select" name="provincia" id="provincia" required>
                            <option value="" selected>Selecciona una provincia</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="municipio">Municipio</label>
                        <select class="form-select" name="municipio" id="municipio" required disabled>
                            <option value="" selected>Selecciona un municipio</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="localidad">Localidad</label>
                        <select class="form-select" name="localidad" id="localidad" required disabled>
                            <option value="" selected>Selecciona una localidad</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="tipo_calle">Tipo de calle</label>
                        <select class="form-select" name="tipo_calle" id="tipo_calle" required>
                            <option value="" selected>Selecciona un tipo de calle</option>
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
                <br>
                <div class="form-group mb-3">
                    <label for="tipo">Tipo</label>
                    <select class="form-select" id="tipo" name="tipo" required>
                        <option value="" selected>Seleccione un tipo</option>
                        <option value="Asociación">Asociación</option>
                        <option value="Fundación">Fundación</option>
                    </select>
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="telefono">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono">
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="web">Web</label>
                    <input type="text" class="form-control" id="web" name="web">
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="redes_sociales">Redes Sociales</label>
                    <div id="redes_sociales">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="redes_sociales[]">
                            <div class="input-group-append">
                                <button class="btn btn-success" type="button" onclick="addRedSocial()">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="logo">Logo</label>
                    <input type="file" class="form-control" id="logo" name="logo" accept="image/*" onchange="previewImage(event, '#imgPreview')" required>
                    <br>
                    <img id="imgPreview" style="height: 200px;">
                </div>
                <br>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="1" id="regional" name="regional">
                    <label class="form-check-label" for="regional">
                        ¿Es una asociación regional?
                    </label>
                </div>
                <button type="button" class="btn btn-primary my-3" id="submitBtn">Crear Asociación</button>

                <!-- Modal de reCAPTCHA -->
                <div class="modal fade" id="recaptchaModal" tabindex="-1" aria-labelledby="recaptchaModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="recaptchaModalLabel">Verificación de reCAPTCHA</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div id="recaptchaWidget" class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_API') }}" data-callback="recaptchaCallback"></div>
                            </div>
                        </div>
                    </div>
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
                <button class="btn btn-danger" type="button" onclick="removeRedSocial(this)">-</button>
            </div>
        `);
        $redesSociales.append($div);
    }

    function removeRedSocial(button) {
        $(button).closest('.input-group').remove();
    }

    function validateForm() {
        let isValid = true;
        $('#asociacionForm').find('input[required], select[required], textarea[required]').each(function() {
            if ($(this).val() === '') {
                isValid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });
        return isValid;
    }

    function loadRecaptcha() {
        grecaptcha.ready(() => {
            grecaptcha.render('recaptchaWidget', {
                sitekey: "{{ env('RECAPTCHA_API') }}",
                callback: recaptchaCallback
            });
        });
    }

    $(document).ready(function() {
        const script = $('<script>', {
            src: 'https://www.google.com/recaptcha/api.js?onload=loadRecaptcha&render=explicit&hl=es',
            async: true,
            defer: true
        });
        $('head').append(script);

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
                const $defaultOption = $('<option>').val('').prop('selected', true).prop('disabled', true).text('Selecciona un municipio');
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
                const $defaultOption = $('<option>').val('').prop('selected', true).prop('disabled', true).text('Selecciona una localidad');
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

        $('#submitBtn').click(function(e) {
            e.preventDefault();
            if (validateForm()) {
                $('#recaptchaModal').modal('show');
                grecaptcha.reset();
            }
        });

    });

    function recaptchaCallback(response) {
        if (!response) {
            alert('Error: Completa el reCAPTCHA');
            return;
        }
        
        // Agregar el token al formulario
        $('#asociacionForm').append(`
            <input type="hidden" name="g-recaptcha-response" value="${response}">
        `);

        // Ocultar el modal
        $('#recaptchaModal').modal('hide');

        // Deshabilitar el botón para evitar doble envío
        $('#submitBtn').prop('disabled', true);
        
        // Enviar el formulario
        $('#asociacionForm').off('submit').submit();
    }

</script>
<script>
    const uploadUrl = "{{ route('upload') }}";
</script>
@include('ckeditor.script')

@stop