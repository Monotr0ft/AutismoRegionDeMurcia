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

    let accesoWeb = document.getElementById('acceso_web');

    accesoWeb.addEventListener('change', function() {
        let usuario = document.getElementById('usuario');
        usuario.style.display = accesoWeb.checked ? 'block' : 'none';
        if (!accesoWeb.checked) {
            document.getElementById('password').required = false;
        } else {
            document.getElementById('password').required = true;
        }
    });

    let juntaDirectiva = document.getElementById('juntaDirectiva');

    juntaDirectiva.addEventListener('change', function() {
        let cargo = document.getElementById('cargo');
        cargo.disabled = !cargo.disabled;
    });

    let provinciaLista = document.getElementById('provincia');

    fetch('https://apiv1.geoapi.es/provincias?type=JSON&key=f830ac50cc0e6b1d1bd1081223bacdf1d8dce93a435988ee74e06b513245e2a2&CCOM=17')
        .then(response => response.json())
        .then(data => {
            data.data.forEach(provincia => {
                let option = document.createElement('option');
                option.value = provincia.PRO;
                option.id = provincia.CPRO;
                option.text = provincia.PRO;
                provinciaLista.appendChild(option);
            });
        });

    let municipioLista = document.getElementById('municipio');

    provinciaLista.addEventListener('change', function() {
        fetch(`https://apiv1.geoapi.es/municipios?type=JSON&key=f830ac50cc0e6b1d1bd1081223bacdf1d8dce93a435988ee74e06b513245e2a2&CPRO=${provinciaLista.options[provinciaLista.selectedIndex].id}`)
            .then(response => response.json())
            .then(data => {
                municipioLista.disabled = false;
                municipioLista.innerHTML = '';
                let option = document.createElement('option');
                option.selected = true;
                option.disabled = true;
                option.text = 'Selecciona un municipio';
                municipioLista.appendChild(option);
                data.data.forEach(municipio => {
                    let option = document.createElement('option');
                    option.value = municipio.DMUN50;
                    option.id = municipio.CMUM;
                    option.text = municipio.DMUN50;
                    municipioLista.appendChild(option);
                });
            });
    });

    let localidadLista = document.getElementById('localidad');

    municipioLista.addEventListener('change', function() {
        fetch(`https://apiv1.geoapi.es/poblaciones?type=JSON&key=f830ac50cc0e6b1d1bd1081223bacdf1d8dce93a435988ee74e06b513245e2a2&CPRO=${provinciaLista.options[provinciaLista.selectedIndex].id}&CMUM=${municipioLista.options[municipioLista.selectedIndex].id}`)
            .then(response => response.json())
            .then(data => {
                localidadLista.disabled = false;
                localidadLista.innerHTML = '';
                let option = document.createElement('option');
                option.selected = true;
                option.disabled = true;
                option.text = 'Selecciona una localidad';
                localidadLista.appendChild(option);
                data.data.forEach(localidad => {
                    let option = document.createElement('option');
                    option.value = localidad.NENTSI50;
                    option.text = localidad.NENTSI50;
                    localidadLista.appendChild(option);
                });
            });
    });

    function estasSeguroCrear() {
        return confirm('¿Estás seguro de que quieres crear este socio?');
    }

    function estasSeguroLimpiar() {
        return confirm('¿Estás seguro de que quieres limpiar el formulario?');
    }

    function estasSeguroVolver() {
        return confirm('¿Estás seguro de que quieres volver a la lista de socios?');
    }
}
</script>

@stop

@section('content')

<div>
    <h1 class="text-center">Crear Socio</h1>
    <div class="row">
        <div class="col-12 col-lg-4">

        </div>
        <form action="{{ route('arba.socio.create') }}" method="POST" class="container my-5 col-12 col-lg-4" onsubmit="return estasSeguroCrear()" onreset="return estasSeguroLimpiar()">
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
            <div class="form-group">
                <h2>Usuario</h2>
                <br>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="acceso_web" value="on" id="acceso_web">
                    <label class="form-check-label" for="acceso_web">
                        ¿Desea darle acceso a la web?
                    </label>
                </div>
                <br>
                <div id="usuario" style="display: none;">
                    <br>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="administracion" value="on" id="administracion">
                        <label class="form-check-label" for="administracion">
                            ¿Desea darle acceso a la administración?
                        </label>
                    </div>
                    <br>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="vivero" value="on" id="vivero">
                        <label class="form-check-label" for="vivero">
                            ¿Desea darle acceso al vivero?
                        </label>
                    </div>
                    <br>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="partes_trabajo" value="on" id="partes_trabajo">
                        <label class="form-check-label" for="partes_trabajo">
                            ¿Desea darle acceso a los partes de trabajo?
                        </label>
                    </div>
                </div>
            </div>
            <br>
            <div class="d-flex justify-content-evenly">
                <button type="submit" class="btn btn-primary">Crear</button>
                <button type="reset" class="btn btn-danger">Limpiar</button>
                <a href="{{ route('arba.socio') }}" onclick="return estasSeguroVolver()" class="btn btn-secondary">Volver</a>
            </div>
        </form>
        <div class="col-12 col-lg-4">

        </div>
    </div>
</div>

@stop
