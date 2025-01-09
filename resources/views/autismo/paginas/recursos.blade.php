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
                <button value="{{ $etiqueta->id }}" class="badge bg-secondary etiqueta-btn">{{ $etiqueta->nombre }}</button>
            @endforeach
        </div>
        <div class="col-12">
            <hr>
        </div>
        <div class="col-12">
            <div class="row" id="recursos-container">
                @foreach ($recursos as $recurso)
                    <div class="col-12 col-md-6 col-lg-4 recurso-card" data-etiquetas="{{ implode(',', $recurso->etiquetas->pluck('id')->toArray()) }}">
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
        $recursoCards.each(function() {
            const etiquetas = $(this).data('etiquetas').split(',').map(Number);
            const hasAllEtiquetas = Array.from(selectedEtiquetas).every(id => etiquetas.includes(parseInt(id)));
            if (selectedEtiquetas.size === 0 || hasAllEtiquetas) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

});

</script>

@stop