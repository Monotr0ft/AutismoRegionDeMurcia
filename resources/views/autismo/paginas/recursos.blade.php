@extends ('autismo.index')

@section('title')

    <title>Autismo Región de Murcia - Recursos</title>

@stop

@section('content')

<div class="contenido">
    <h2 class="text-center my-5">Recursos</h2>
    <div class="row my-2">
        <div class="col-12 d-flex flex-wrap gap-2">
            @foreach ($etiquetas as $etiqueta)
                <button value="{{ $etiqueta->id }}" class="badge bg-secondary">{{ $etiqueta->nombre }}</button>
            @endforeach
        </div>
        <div class="col-12">
            <hr>
        </div>
        <div class="col-12">
            <div class="row">
                @foreach ($recursos as $recurso)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card">
                            <h3 class="card-header" style="background-color: #788AA3;">{{ $recurso->titulo }}</h3>
                            <div class="card-body" style="background-color: #CCCCCC;">
                                @if ($recurso->url)
                                    <a class="btn btn-more" href="https://{{ $recurso->url }}" target="_blank">Ver recurso</a>
                                @else
                                    <a class="btn btn-more" href="{{ $recurso->archivo }}" target="_blank">Ver recurso</a>
                                @endif
                                <br>
                                <br>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach ($recurso->etiquetas as $etiqueta)
                                        <span class="badge bg-primary" id="{{ $etiqueta->id }}">{{ $etiqueta->nombre }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const etiquetaButtons = document.querySelectorAll('.etiqueta-btn');
        const recursoCards = document.querySelectorAll('.recurso-card');

        etiquetaButtons.forEach(button => {
            button.addEventListener('click', function() {
                const etiquetaId = this.value;
                recursoCards.forEach(card => {
                    const etiquetas = card.getAttribute('data-etiquetas').split(',');
                    if (etiquetas.includes(etiquetaId)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    });
</script>

@stop