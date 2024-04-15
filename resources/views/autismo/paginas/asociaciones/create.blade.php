@extends('autismo.index')

@section('title')

<title>
    Autismo Región de Murcia - Crear Asociación
</title>
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
</script>

@stop

@section('content')

<div>
    <div class="my-5 text-center">
        <h2>Crear Asociación</h2>
    </div>
    <div class="row">
        <div class="col-12 col-md-4"></div>
        <div class="col-12 col-md-4">
            <form action="{{ route('asociaciones.create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="20" required></textarea>
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="tipo">Tipo</label>
                    <select class="form-select" id="tipo" name="tipo" required>
                        <option selected>Seleccione un tipo</option>
                        <option value="Asociación">Asociación</option>
                        <option value="Fundación">Fundación</option>
                    </select>
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="direccion">Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion">
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="telefono">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono">
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
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
                            <input type="text" class="form-control" name="redes_sociales[]" required>
                            <div class="input-group-append">
                                <button class="btn btn-success" type="button" onclick="addRedSocial()">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="logo">Logo</label>
                    <input type="file" class="form-control" id="logo" name="logo" accept="image/*" onchange="previewImage(event, '#imgPreview')">
                    <br>
                    <img id="imgPreview" width="200">
                </div>
                <br>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="1" id="regional" name="regional">
                    <label class="form-check-label" for="regional">
                        ¿Es una asociación regional?
                    </label>
                </div>
                <button type="submit" class="btn btn-primary my-3">Crear Asociación</button>
            </form>
        </div>
        <div class="col-12 col-md-4"></div>
    </div>
</div>

@stop