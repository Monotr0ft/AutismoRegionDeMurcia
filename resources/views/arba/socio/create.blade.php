@extends('arba.dashboard')

@section('title')

<title>ARBA - Crear Socio</title>
<script>
    window.onload = function() {

    let direcciones = document.getElementById('direcciones');

    direcciones.addEventListener('change', function() {
        let nuevaDireccion = document.getElementById('nueva_direccion');
        nuevaDireccion.style.display = direcciones.value == 0 ? 'block' : 'none';
        if (direcciones.value != 0) {
            document.getElementById('tipo_calle').required = false;
            document.getElementById('nombre_calle').required = false;
            document.getElementById('numero').required = false;
            document.getElementById('codigo_postal').required = false;
            document.getElementById('provincia').required = false;
            document.getElementById('municipio').required = false;
            document.getElementById('localidad').required = false;
        } else {
            document.getElementById('tipo_calle').required = true;
            document.getElementById('nombre_calle').required = true;
            document.getElementById('numero').required = true;
            document.getElementById('codigo_postal').required = true;
            document.getElementById('provincia').required = true;
            document.getElementById('municipio').required = true;
            document.getElementById('localidad').required = true;
        }
    });

    let juntaDirectiva = document.getElementById('juntaDirectiva');

    juntaDirectiva.addEventListener('change', function() {
        let cargo = document.getElementById('cargo');
        cargo.disabled = !cargo.disabled;
    });

    fetch('{{asset('assets/js/arbol.json')}}')
        .then((response) => response.json())
        .then((data) => {
            let lista = data;
            lista = lista.filter((item) => item.code == 14);
            console.log(lista);
            let provincias = document.getElementById('provincia');
            lista[0].provinces.forEach((provincia) => {
                let option = document.createElement('option');
                option.value = provincia.label;
                option.text = provincia.label;
                provincias.appendChild(option);
            });
            
            provincias.addEventListener('change', function() {
                let municipios = document.getElementById('municipio');
                municipios.disabled = false;
                municipios.innerHTML = '<option selected>Selecciona un municipio</option>';
                let provincia = provincias.value;
                let municipiosProvincia = lista[0].provinces.filter((provinciaItem) => provinciaItem.label == provincia);
                municipiosProvincia[0].towns.forEach((municipio) => {
                    let option = document.createElement('option');
                    option.value = municipio.label;
                    option.text = municipio.label;
                    municipios.appendChild(option);
                });
            });

            // Ahora, que haga lo mismo con las localidades

            let municipios = document.getElementById('municipio');

            municipios.addEventListener('change', function() {
                let localidades = document.getElementById('localidad');
                localidades.disabled = false;
                localidades.innerHTML = '<option selected>Selecciona una localidad</option>';
                let municipio = municipios.value;
                let municipiosProvincia = lista[0].provinces.filter((provinciaItem) => provinciaItem.label == provincias.value);
                let localidadesMunicipio = municipiosProvincia[0].towns.filter((municipioItem) => municipioItem.label == municipio);
                localidadesMunicipio[0].pedanias.forEach((localidad) => {
                    let option = document.createElement('option');
                    option.value = localidad.label;
                    option.text = localidad.label;
                    localidades.appendChild(option);
                });
            });

        })
    }
</script>

@stop

@section('content')

<div>
    <h1 class="text-center">Crear Socio</h1>
    <div class="row">
        <div class="col-12 col-lg-4">

        </div>
        <form action="{{ route('arba.socio.create') }}" method="POST" class="container my-5 col-12 col-lg-4">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required>
            </div>
            <br>
            <div class="form-group">
                <label for="apellido_1">Apellido 1</label>
                <input type="text" class="form-control" name="apellido_1" id="apellido_1" placeholder="Apellido 1" required>
            </div>
            <br>
            <div class="form-group">
                <label for="apellido_2">Apellido 2</label>
                <input type="text" class="form-control" name="apellido_2" id="apellido_2" placeholder="Apellido 2" required>
            </div>
            <br>
            <div class="form-group">
                <label for="dni">DNI</label>
                <input type="text" class="form-control" name="dni" id="dni" placeholder="DNI" required>
            </div>
            <br>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Teléfono" required>
            </div>
            <br>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
            </div>
            <br>
            <div class="form-group">
                <label for="fecha_alta">Fecha de alta</label>
                <input type="date" class="form-control" name="fecha_alta" id="fecha_alta" required>
            </div>
            <br>
            <div class="form-group">
                <h2>Dirección</h2>
                <br>
                <select class="form-select" name="direcciones" id="direcciones" required>
                    <option value="0" selected>Nueva dirección</option>
                    @foreach ($direcciones as $direccion)
                        @if ($direccion->ampliacion == null)
                            <option value="{{ $direccion->id }}">{{ $direccion->tipo_via }} {{ $direccion->nombre_via }} {{ $direccion->numero }}, {{ $direccion->provincia }}, {{ $direccion->municipio }}, {{ $direccion->localidad }}, {{ $direccion->codigo_postal }}</option>
                        @else
                            <option value="{{ $direccion->id }}">{{ $direccion->tipo_via }} {{ $direccion->nombre_via }} {{ $direccion->numero }} {{ $direccion->ampliacion }}, {{ $direccion->provincia }}, {{ $direccion->municipio }}, {{ $direccion->localidad }}, {{ $direccion->codigo_postal }}</option>
                        @endif
                    @endforeach
                </select>
                <br>
                <div id="nueva_direccion">
                    <select class="form-select" name="tipo_calle" id="tipo_calle" required>
                        <option selected>Selecciona un tipo de calle</option>
                        <option value="Calle">Calle</option>
                        <option value="Avda">Avenida</option>
                        <option value="Travesia">Travesia</option>
                        <option value="Carretera">Carretera</option>
                    </select>
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
                    <br>
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
                </div>
            </div>
            <br>
            <div class="form-group">
                <h2>Junta Directiva</h2>
                <br>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="juntaDirectiva" value="on" id="juntaDirectiva">
                    <label class="form-check-label" for="juntaDirectiva">
                        ¿Forma parte de la Junta Directiva?
                    </label>
                </div>
                <br>
                <select class="form-select" name="cargo" id="cargo" disabled required>
                    <option selected>Selecciona un cargo</option>
                    <option value="Presidente/a">Presidente/a</option>
                    <option value="Vicepresidente/a">Vicepresidente/a</option>
                    <option value="Tesorero/a">Tesorero/a</option>
                    <option value="Secretario/a">Secretario/a</option>
                    <option value="Vocal">Vocal</option>
                </select>
            </div>
            <br>
            <button type="submit" class="btn btn-primary my-3">Crear</button>
        </form>
        <div class="col-12 col-lg-4">

        </div>
    </div>
</div>

@stop
