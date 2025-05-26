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
                <button value="{{ $etiqueta->id }}" class="badge bg-more etiqueta-btn">{{ $etiqueta->nombre }}</button>
            @endforeach
        </div>
        <div class="col-12">
            <hr>
        </div>
        <div class="col-12">
            <div class="row" id="recursos-container">
                @foreach ($recursos as $recurso)
                    <div class="col-12 col-md-6 col-lg-4 my-3 align-items-stretch">
                        <div class="card border-more h-100 w-100 d-flex flex-column recurso-card" data-etiquetas="{{ implode(',', $recurso->etiquetas->pluck('id')->toArray()) }}">
                            <h3 class="card-header" style="background-color:rgb(95, 140, 207);">{{ $recurso->titulo }}</h3>
                            <div class="card-body">
                                @if ($recurso->descripcion)
                                <p class="card-text">
                                        {{ $recurso->descripcion }}
                                </p>
                                @endif
                                <br>
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

$(function() {
    const $etiquetaButtons = $('.etiqueta-btn');
    // Selecciona las columnas de recursos correctamente
    const $recursoCols = $('#recursos-container .col-12');
    const selectedEtiquetas = new Set();

    // Mostrar todos los recursos al cargar
    $recursoCols.show();

    $etiquetaButtons.click(function() {
        const etiquetaId = $(this).val();
        // Alternar selección visual y lógica
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
            $recursoCols.stop(true, true).fadeIn(200);
            return;
        }
        $recursoCols.each(function() {
            const $card = $(this).find('.recurso-card');
            let etiquetasStr = $card.data('etiquetas');
            let etiquetasArray = etiquetasStr ? etiquetasStr.toString().split(',') : [];
            // Mostrar si alguna etiqueta coincide
            const mostrar = Array.from(selectedEtiquetas).some(id => etiquetasArray.includes(id));
            if (mostrar) {
                $(this).stop(true, true).fadeIn(200);
            } else {
                $(this).stop(true, true).fadeOut(200);
            }
        });
    }
});

</script>

@stop