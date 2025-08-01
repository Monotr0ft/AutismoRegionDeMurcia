@extends ('autismo.dashboard.index')

@section ('title')

    <title>Dashboard Autismo Región de Murcia - Noticias</title>
    <script>

        function confirmDelete() {
            return confirm('¿Estás seguro de que quieres eliminar esta noticia?');
        }

    </script>

@stop

@section ('content')

<div class="row">
    <div class="col-12">
        <h1 class="text-center">Noticias</h1>
    </div>
</div>
<br>
<div class="text-center">
    <a href="{{ route('dashboard.noticias.create') }}" class="btn btn-primary">Crear nueva noticia</a>
</div>
<br>
<div class="row">
    <div class="col-12 table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Enlace</th>
                    <th>Fecha</th>
                    <th>Comentario</th>
                    <th>¿Está publicada?</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($noticias as $noticia)
                    <tr>
                        <td>{{ $noticia->titulo }}</td>
                        <td><a href="https://{{ $noticia->url }}">Ver noticia</a></td>
                        <td>{{ $noticia->fecha }}</td>
                        <td>
                            @if ($noticia->comentario)
                                {{ $noticia->comentario }}
                            @else
                                Sin comentario
                            @endif
                        </td>
                        <td>
                            @if ($noticia->publicar)
                                Sí
                            @else
                                No
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('dashboard.noticias.edit', $noticia->id) }}" class="btn btn-warning">Editar</a>
                            @if (!$noticia->publicar)
                                <form action="{{ route('dashboard.noticias.publicar', $noticia->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success" onclick="return confirm('¿Estás seguro de que quieres publicar esta noticia?')">Publicar</button>
                                </form>
                            @else
                                <form action="{{ route('dashboard.noticias.ocultar', $noticia->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres ocultar esta noticia?')">Ocultar</button>
                                </form>
                            @endif
                            <form action="#" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirmDelete()">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop
