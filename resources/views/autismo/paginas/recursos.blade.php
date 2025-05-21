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
                    <div class="col-12 col-md-6 col-lg-4 my-3 d-flex align-items-stretch">
                        <div class="card border-more h-100 w-100 d-flex flex-column recurso-card" data-etiquetas="{{ implode(',', $recurso->etiquetas->pluck('id')->toArray()) }}">
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
    const $recursoCards = $('.recurso-card').parent();
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
            // Mostrar todos cuando no hay filtros seleccionados
            $recursoCards.fadeIn(200, function() {
                $(this).css('display', 'flex'); // Asegurarse de que se muestren como flex
            });
            return;
        }
        
        $recursoCards.each(function() {
            const $card = $(this).find('.recurso-card');
            let etiquetasStr = $card.attr('data-etiquetas');
            let etiquetasArray = etiquetasStr ? etiquetasStr.split(',') : [];
            
            // Verificar si alguna de las etiquetas seleccionadas está en este recurso
            let mostrar = false;
            for (const etiquetaId of selectedEtiquetas) {
                if (etiquetasArray.includes(etiquetaId)) {
                    mostrar = true;
                    break;
                }
            }
            
            if (mostrar) {
                $(this).fadeIn(200, function() {
                    $(this).css('display', 'flex'); // Mantener el display flex
                });
            } else {
                $(this).fadeOut(200, function() {
                    $(this).css('display', 'none'); // Asegurar que se oculte completamente
                });
            }
        });
    }
});

</script>

@stop