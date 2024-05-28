@extends ('autismo.dashboard.index')

@section ('title')

    <title>Dashboard Autismo Región de Murcia - Páginas</title>
    <script>

        function confirmDelete() {
            return confirm('¿Estás seguro de que quieres eliminar esta página?');
        }

    </script>

@stop

@section ('content')

<div class="row">
    <div class="col-12">
        <h1 class="text-center">Páginas</h1>
    </div>
</div>
<br>
<div class="d-flex justify-content-between align-items-center">
    <div>
        <a href="{{ route('dashboard.asociacionesnuevas') }}" class="btn btn-secondary">Cambiar a Peticiones de Asociaciones</a>
    </div>
    <div>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cambiar a Asociaciones</a>
    </div>
    <div>
        <a href="{{ route('dashboard.noticias') }}" class="btn btn-secondary">Cambiar a Noticias</a>
    </div>
</div>
<br>
<div class="text-center">
    <a href="{{ route('dashboard.paginas.create') }}" class="btn btn-primary">Crear nueva página</a>
</div>
<br>
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
    @foreach ($paginas as $pagina)
        <div class="col d-flex align-items-stretch">
            <div class="card" style="width: 100%">
                <div class="card-header">
                    <h2>{{ $pagina->titulo }}</h2>
                </div>
                <div class="card-body d-flex justify-content-between align-items-center">
                    <a href="{{ route('dashboard.paginas.show', $pagina->id) }}" class="btn btn-primary">Ver</a>
                    <a href="{{ action([\App\Http\Controllers\PaginaController::class, 'getEdit'], $pagina->id) }}" class="btn btn-warning">Editar</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@stop
