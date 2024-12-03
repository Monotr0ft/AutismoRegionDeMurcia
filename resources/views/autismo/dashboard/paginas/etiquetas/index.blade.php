@extends ('autismo.dashboard.index')

@section ('title')

<title>Dashboard Autismo Región de Murcia - Etiquetas</title>

<script>

    function confirmDelete() {
        return confirm('¿Estás seguro de que quieres eliminar esta etiqueta?');
    }

</script>

@endsection

@section ('content')

<div class="row">
    <div class="col-12">
        <h1 class="text-center">Etiquetas</h1>
    </div>
</div>
<br>
<div class="text-center">
    <a href="{{ route('dashboard.etiquetas.create') }}" class="btn btn-primary">Crear etiqueta</a>
</div>
<br>
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
    @foreach ($etiquetas as $etiqueta)
    <div class="col d-flex align-items-stretch">
        <div class="card" style="width: 100%;">
            <div class="card-header">
                <h2>{{ $etiqueta->nombre }}</h2>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <a href="{{ route('dashboard.etiquetas.edit', $etiqueta->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('dashboard.etiquetas.delete', $etiqueta->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirmDelete()">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection
