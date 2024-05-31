@extends ('arba.dashboard')

@section ('title')

    <title>ARBA - Editar Socio</title>
    <script>
    window.onload = function() {

    let estado = document.getElementById('estado');

    estado.addEventListener('change', function() {
        let fechaBaja = document.getElementById('fecha_baja');
        fechaBaja.disabled = !fechaBaja.disabled;
    });

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

    let provinciaLista = document.getElementById('provincia');

    fetch('https://apiv1.geoapi.es/provincias?type=JSON&key=f830ac50cc0e6b1d1bd1081223bacdf1d8dce93a435988ee74e06b513245e2a2&CCOM=17')
        .then(response => response.json())
        .then(data => {
            data.data.forEach(provincia => {
                let option = document.createElement('option');
                let provinciaNombre = provincia.PRO.toLowerCase().split(' ').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
                option.value = provinciaNombre;
                option.id = provincia.CPRO;
                option.text = provinciaNombre;
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
                    let municipioNombre = municipio.DMUN50.split(/(\(.*?\))/).map((segment, index) => {
                        if (index % 2 === 0) {
                            return segment.toLowerCase().split(' ').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
                        } else {
                            return segment.charAt(0) + segment.charAt(1).toUpperCase() + segment.slice(2).toLowerCase();
                        }
                    }).join('');
                    option.value = municipioNombre;
                    option.id = municipio.CMUM;
                    option.text = municipioNombre;
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
                    let localidadNombre = localidad.NENTSI50.split(/(\(.*?\))/).map((segment, index) => {
                        if (index % 2 === 0) {
                            return segment.toLowerCase().split(' ').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
                        } else {
                            return segment.charAt(0) + segment.charAt(1).toUpperCase() + segment.slice(2).toLowerCase();
                        }
                    }).join('');
                    option.value = localidad.NENTSI50;
                    option.text = localidad.NENTSI50;
                    localidadLista.appendChild(option);
                });
            });
    });

    function estasSeguroEditar() {
        return confirm('¿Estás seguro de que quieres editar este socio?');
    }

    function estasSeguroVolver() {
        return confirm('¿Estás seguro de que quieres volver a la lista de socios?');
    }
}
    </script>

@stop

@section ('content')

<div>
    <h1 class="text-center">Editar Socio {{ $socio->nombre }} {{ $socio->apellido1 }} {{ $socio->apellido2 }}</h1>
    <div class="row">
        <div class="col-12 col-lg-4">

        </div>
        <form action="{{ route('arba.socio.edit', $socio->id) }}" method="POST" class="container my-5 col-12 col-lg-4" onsubmit="return estasSeguroEditar()">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" value="{{ $socio->nombre }}" placeholder="Nombre" required>
            </div>
            <br>
            <div class="form-group">
                <label for="apellido_1">Apellido 1</label>
                <input type="text" class="form-control" name="apellido_1" id="apellido_1" value="{{ $socio->apellido1 }}" placeholder="Apellido 1" required>
            </div>
            <br>
            <div class="form-group">
                <label for="apellido_2">Apellido 2</label>
                <input type="text" class="form-control" name="apellido_2" id="apellido_2" value="{{ $socio->apellido2 }}" placeholder="Apellido 2" required>
            </div>
            <br>
            <div class="form-group">
                <label for="dni">DNI</label>
                <input type="text" class="form-control" name="dni" id="dni" value="{{ $socio->dni }}" placeholder="DNI" required>
            </div>
            <br>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control" name="telefono" id="telefono" value="{{ $socio->telefono }}" placeholder="Teléfono" required>
            </div>
            <br>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ $socio->email }}" placeholder="Email" required>
            </div>
            <br>
            <div class="form-group">
                <label for="fecha_alta">Fecha de alta</label>
                <input type="date" class="form-control" name="fecha_alta" id="fecha_alta" value="{{ $socio->fecha_alta }}" required>
            </div>
            <br>
            <div class="form-check">
                @if ($socio->activo == 1)
                    <input class="form-check-input" type="checkbox" name="estado" value="on" id="estado" checked>
                @else
                    <input class="form-check-input" type="checkbox" name="estado" value="on" id="estado">
                @endif
                <label class="form-check-label" for="estado">
                    ¿Está activo?
                </label>
            </div>
            <div class="form-check">
                @if ($socio->acceso_web == 1)
                    <input class="form-check-input" type="checkbox" name="acceso_web" value="on" id="acceso_web" checked>
                @else
                    <input class="form-check-input" type="checkbox" name="acceso_web" value="on" id="acceso_web">
                @endif
                <label class="form-check-label" for="acceso_web">
                    ¿Tiene acceso a la web?
                </label>
            </div>
            <br>
            <div class="form-check">
                @if ($socio->administracion == 1)
                    <input class="form-check-input" type="checkbox" name="administracion" value="on" id="administracion" checked>
                @else
                    <input class="form-check-input" type="checkbox" name="administracion" value="on" id="administracion">
                @endif
                <label class="form-check-label" for="administracion">
                    ¿Tiene acceso a la administración?
                </label>
            </div>
            <br>
            <div class="form-check">
                @if ($socio->vivero == 1)
                    <input class="form-check-input" type="checkbox" name="vivero" value="on" id="vivero" checked>
                @else
                    <input class="form-check-input" type="checkbox" name="vivero" value="on" id="vivero">
                @endif
                <label class="form-check-label" for="vivero">
                    ¿Tiene acceso al vivero?
                </label>
            </div>
            <br>
            <div class="form-check">
                @if ($socio->partes_trabajo == 1)
                    <input class="form-check-input" type="checkbox" name="partes_trabajo" value="on" id="partes_trabajo" checked>
                @else
                    <input class="form-check-input" type="checkbox" name="partes_trabajo" value="on" id="partes_trabajo">
                @endif
                <label class="form-check-label" for="partes_trabajo">
                    ¿Tiene acceso a los partes de trabajo?
                </label>
            </div>
            <br>
            <div class="form-group">
                <label for="fecha_baja">Fecha de baja</label>
                @if ($socio->fecha_baja != null)
                    <input type="date" class="form-control" name="fecha_baja" id="fecha_baja" value="{{ $socio->fecha_baja }}" required>
                @else
                    @if ($socio->activo == 1)
                        <input type="date" class="form-control" name="fecha_baja" id="fecha_baja" disabled>
                    @else
                        <input type="date" class="form-control" name="fecha_baja" id="fecha_baja" required>
                    @endif
                @endif
            </div>
            <br>
            <div class="form-group">
                <h2>Dirección</h2>
                <br>
                <select class="form-select" name="direcciones" id="direcciones" required>
                    <option value="0">Nueva dirección</option>
                    @foreach ($direcciones as $direccion)
                    @if ($direccion->ampliacion == null)
                            @if (iconv('UTF-8', 'ASCII//TRANSLIT', $direccion->municipio) != iconv('UTF-8', 'ASCII//TRANSLIT', $direccion->localidad))
                                @if ($direccion->id == $socio->direccion_id)
                                    <option value="{{ $direccion->id }}" selected>{{ $direccion->tipo_via }} {{ $direccion->nombre_via }}, {{ $direccion->numero }}, {{ $direccion->localidad }}, {{ $direccion->municipio }} ({{ $direccion->provincia }})</option>
                                @else
                                    <option value="{{ $direccion->id }}">{{ $direccion->tipo_via }} {{ $direccion->nombre_via }}, {{ $direccion->numero }}, {{ $direccion->localidad }}, {{ $direccion->municipio }} ({{ $direccion->provincia }})</option>
                                @endif
                            @else
                                @if ($direccion->id == $socio->direccion_id)
                                    <option value="{{ $direccion->id }}" selected>{{ $direccion->tipo_via }} {{ $direccion->nombre_via }}, {{ $direccion->numero }}, {{ $direccion->municipio }} ({{ $direccion->provincia }})</option>
                                @else
                                    <option value="{{ $direccion->id }}">{{ $direccion->tipo_via }} {{ $direccion->nombre_via }}, {{ $direccion->numero }}, {{ $direccion->municipio }} ({{ $direccion->provincia }})</option>
                                @endif
                            @endif
                        @else
                            @if (iconv('UTF-8', 'ASCII//TRANSLIT', $direccion->municipio) != iconv('UTF-8', 'ASCII//TRANSLIT', $direccion->localidad))
                                @if ($direccion->id == $socio->direccion_id)
                                    <option value="{{ $direccion->id }}" selected>{{ $direccion->tipo_via }} {{ $direccion->nombre_via }}, {{ $direccion->numero }}, {{ $direccion->ampliacion }}, {{ $direccion->localidad }}, {{ $direccion->municipio }} ({{ $direccion->provincia }})</option>
                                @else
                                    <option value="{{ $direccion->id }}">{{ $direccion->tipo_via }} {{ $direccion->nombre_via }}, {{ $direccion->numero }}, {{ $direccion->ampliacion }}, {{ $direccion->localidad }}, {{ $direccion->municipio }} ({{ $direccion->provincia }})</option>
                                @endif
                            @else
                                @if ($direccion->id == $socio->direccion_id)
                                    <option value="{{ $direccion->id }}" selected>{{ $direccion->tipo_via }} {{ $direccion->nombre_via }}, {{ $direccion->numero }}, {{ $direccion->ampliacion }}, {{ $direccion->municipio }} ({{ $direccion->provincia }})</option>
                                @else
                                    <option value="{{ $direccion->id }}">{{ $direccion->tipo_via }} {{ $direccion->nombre_via }}, {{ $direccion->numero }}, {{ $direccion->ampliacion }}, {{ $direccion->municipio }} ({{ $direccion->provincia }})</option>
                                @endif
                            @endif
                        @endif
                    @endforeach
                </select>
                <br>
                <div id="nueva_direccion" style="display: none">
                    <select class="form-select" name="tipo_calle" id="tipo_calle">
                        <option selected>Selecciona un tipo de calle</option>
                        <option value="Calle">Calle</option>
                        <option value="Avda">Avenida</option>
                        <option value="Travesia">Travesia</option>
                        <option value="Carretera">Carretera</option>
                    </select>
                    <br>
                    <div class="form-group">
                        <label for="nombre_calle">Nombre de la calle</label>
                        <input type="text" class="form-control" name="nombre_calle" id="nombre_calle" placeholder="Nombre de la calle">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="numero">Número</label>
                        <input type="text" class="form-control" name="numero" id="numero" placeholder="Número">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="ampliacion">Ampliación</label>
                        <input type="text" class="form-control" name="ampliacion" id="ampliacion" placeholder="Ampliación">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="codigo_postal">Código postal</label>
                        <input type="text" class="form-control" name="codigo_postal" id="codigo_postal" placeholder="Código postal">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="provincia">Provincia</label>
                        <select class="form-select" name="provincia" id="provincia">
                            <option selected>Selecciona una provincia</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="municipio">Municipio</label>
                        <select class="form-select" name="municipio" id="municipio" disabled>
                            <option selected>Selecciona un municipio</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="localidad">Localidad</label>
                        <select class="form-select" name="localidad" id="localidad" disabled>
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
                    @if ($socio->junta_directiva == 1)
                        <input class="form-check-input" type="checkbox" name="juntaDirectiva" value="on" id="juntaDirectiva" checked>
                    @else
                        <input class="form-check-input" type="checkbox" name="juntaDirectiva" value="on" id="juntaDirectiva">
                    @endif
                    <label class="form-check-label" for="juntaDirectiva">
                        ¿Forma parte de la Junta Directiva?
                    </label>
                </div>
                <br>
                @if ($socio->junta_directiva == 1)
                    <select class="form-select" name="cargo" id="cargo" required>
                        <option>Selecciona un cargo</option>
                        @if ($socio->posicion == 'Presidente/a')
                            <option value="Presidente/a" selected>Presidente/a</option>
                        @else
                            <option value="Presidente/a">Presidente/a</option>
                        @endif
                        @if ($socio->posicion == 'Vicepresidente/a')
                            <option value="Vicepresidente/a" selected>Vicepresidente/a</option>
                        @else
                            <option value="Vicepresidente/a">Vicepresidente/a</option>
                        @endif
                        @if ($socio->posicion == 'Tesorero/a')
                            <option value="Tesorero/a" selected>Tesorero/a</option>
                        @else
                            <option value="Tesorero/a">Tesorero/a</option>
                        @endif
                        @if ($socio->posicion == 'Secretario/a')
                            <option value="Secretario/a" selected>Secretario/a</option>
                        @else
                            <option value="Secretario/a">Secretario/a</option>
                        @endif
                        @if ($socio->posicion == 'Vocal')
                            <option value="Vocal" selected>Vocal</option>
                        @else
                            <option value="Vocal">Vocal</option>
                        @endif
                    </select>
                @else
                    <select class="form-select" name="cargo" id="cargo" disabled required>
                        <option selected>Selecciona un cargo</option>
                        <option value="Presidente/a">Presidente/a</option>
                        <option value="Vicepresidente/a">Vicepresidente/a</option>
                        <option value="Tesorero/a">Tesorero/a</option>
                        <option value="Secretario/a">Secretario/a</option>
                        <option value="Vocal">Vocal</option>
                    </select>
                @endif
            </div>
            <br>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-warning">Editar</button>
                <a href="{{ route('arba.socio.show', $socio->id) }}" class="btn btn-secondary" onclick="return estasSeguroVolver()">Volver</a>
            </div>
        </form>
        <div class="col-12 col-lg-4">

        </div>
    </div>
</div>

@stop
