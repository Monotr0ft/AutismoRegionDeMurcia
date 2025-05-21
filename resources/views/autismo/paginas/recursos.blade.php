@extends ('autismo.index')

@section('title')

    <title>Autismo Región de Murcia - Recursos</title>

@stop

@section('content')

<div class="contenido">
    <h2 class="text-center my-5">Recursos</h2>
    <div class="row my-2">
        <div class="col-12 d-flex flex-wrap gap-2">
            <p>Filtros:</p>
            <br>
            @foreach ($etiquetas as $etiqueta)
                <button value="{{ $etiqueta->id }}" class="badge bg-secondary etiqueta-btn">{{ $etiqueta->nombre }}</button>
            @endforeach
        </div>
        <div class="col-12">
            <hr>
        </div>
        <div class="col-12">
            <div class="row" id="recursos-container">
                @foreach ($recursos as $recurso)
                    <div class="col-12 col-md-6 col-lg-4 my-3 d-flex align-items-stretch recurso-card" data-etiquetas="{{ implode(',', $recurso->etiquetas->pluck('id')->toArray()) }}">
                        <div class="card border-more h-100 d-flex flex-column">
                            <h3 class="card-header" style="background-color:rgb(95, 140, 207);">{{ $recurso->titulo }}</h3>
                            <div class="card-body">
                                @if ($recurso->url)
                                    <a class="btn btn-more" href="https://{{ $recurso->url }}" target="_blank">Ver recurso</a>
                                @else
                                    <a class="btn btn-more" href="{{ asset($recurso->archivo) }}" target="_blank">Ver recurso</a>
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

$(document).ready(function() {
    const $etiquetaButtons = $('.etiqueta-btn');
    const $recursoCards = $('.recurso-card');
    const selectedEtiquetas = new Set();

    $etiquetaButtons.click(function() {
        const etiquetaId = $(this).val();
        if (selectedEtiquetas.has(etiquetaId)) {
            selectedEtiquetas.delete(etiquetaId);
            $(this).removeClass('bg-primary').addClass('bg-secondary');
        } else {
            selectedEtiquetas.add(etiquetaId);
            $(this).removeClass('bg-secondary').addClass('bg-primary');
        }
        filterRecursos();
    });

    function filterRecursos() {
        if (selectedEtiquetas.size === 0) {
            $recursoCards.show();
        } else {
            $recursoCards.each(function() {
                const recursoEtiquetas = $(this).data('etiquetas').split(',');
                const hasSelectedEtiqueta = recursoEtiquetas.some(etiqueta => selectedEtiquetas.has(etiqueta));
                if (hasSelectedEtiqueta) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
    }
});

</script>

@stop