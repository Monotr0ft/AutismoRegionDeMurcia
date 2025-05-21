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
console.log('Script de recursos cargado'); // Debug para saber si el script se ejecuta

$(function() {
    const $etiquetaButtons = $('.etiqueta-btn');
    const $recursoCards = $('.recurso-card').parent();
    const selectedEtiquetas = new Set();

    // Asegurarnos que al iniciar todos los recursos estén visibles
    $recursoCards.show();

    $etiquetaButtons.click(function() {
        const etiquetaId = $(this).val();
        console.log('Botón etiqueta clickeado:', etiquetaId);
        if (selectedEtiquetas.has(etiquetaId)) {
            selectedEtiquetas.delete(etiquetaId);
            $(this).removeClass('bg-primary').addClass('bg-secondary');
        } else {
            selectedEtiquetas.add(etiquetaId);
            $(this).removeClass('bg-secondary').addClass('bg-primary');
        }
        console.log('Etiquetas seleccionadas:', Array.from(selectedEtiquetas));
        filterRecursos();
    });

    function filterRecursos() {
        // Si no hay etiquetas seleccionadas, mostrar todos los recursos
        if (selectedEtiquetas.size === 0) {
            console.log('Ninguna etiqueta seleccionada, mostrando todos los recursos');
            $recursoCards.show();
            return;
        }
        
        // Examinar cada recurso para decidir si mostrarlo u ocultarlo
        $recursoCards.each(function() {
            const $card = $(this).find('.recurso-card');
            let etiquetasStr = $card.attr('data-etiquetas');
            let etiquetasArray = etiquetasStr ? etiquetasStr.split(',') : [];
            console.log('Recurso etiquetas:', etiquetasArray, 'Etiquetas seleccionadas:', Array.from(selectedEtiquetas));
            
            // Verificar si el recurso tiene alguna de las etiquetas seleccionadas
            let mostrar = Array.from(selectedEtiquetas).some(etiquetaId => 
                etiquetasArray.includes(etiquetaId)
            );
            console.log('¿Mostrar este recurso?', mostrar);

            // Mostrar u ocultar directamente sin animaciones
            if (mostrar) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }
});
</script>

@stop