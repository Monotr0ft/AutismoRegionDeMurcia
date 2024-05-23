@extends('autismo.dashboard.index')

@section('title')

    <title>Dashboard Autismo Región de Murcia - Asociaciones</title>
    <style>
        .ck-editor__editable_inline {
            min-height: 400px;
        }
    </style>
    <script src="{{ asset('/assets/ckeditor5/build/ckeditor.js') }}"></script>
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
        function addRedSocial() {
            const redes_sociales = document.getElementById('redes_sociales');
            const div = document.createElement('div');
            div.classList.add('input-group', 'mb-3');
            div.innerHTML = `
                <input type="text" class="form-control" name="redes_sociales[]" required>
                <button type="button" class="btn btn-danger" onclick="this.parentElement.remove()">Eliminar</button>
            `;
            redes_sociales.appendChild(div);
        }
        function removeRedSocial(button) {
            const div = button.parentNode.parentNode;
            div.parentNode.removeChild(div);
        }
        function confirmEdit() {
            return confirm('¿Estás seguro de que quieres editar esta asociación?');
        }
        function confirmVolver() {
            return confirm('¿Estás seguro de que quieres volver a Asociaciones Nuevas?');
        }
    </script>

@stop

@section('content')

<div>
    <div class="my-5 text-center">
        <h2>Editar {{ $asociacion->tipo }} {{ $asociacion->nombre }}</h2>
    </div>
    <div class="row">
        <div class="col-12 col-md-4"></div>
        <div class="col-12 col-md-4">
            <form action="{{ route('dashboard.asociaciones.edit', $asociacion->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirmEdit()">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $asociacion->nombre }}" required>
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="20" required>{{ $asociacion->descripcion }}</textarea>
                </div>
                <br>
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
                    <img src="" alt="" class="img-fluid" id="logoPreview" width="200">
                    <br>
                    <img src="{{ asset($asociacion->logo) }}" alt="{{ $asociacion->nombre }}" class="img-fluid" id="logoNow" width="200">
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="direccion">Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" value="{{ $asociacion->direccion }}" required>
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="telefono">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $asociacion->telefono }}">
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $asociacion->email }}" required>
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
                                    <input type="text" class="form-control" name="redes_sociales[]" value="{{ $red_social }}" required>
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
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary" onclick="return confirmVolver()">Volver a Asociaciones</a>
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
