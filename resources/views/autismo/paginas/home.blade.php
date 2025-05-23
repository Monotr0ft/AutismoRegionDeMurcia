@extends('autismo.index')

@section('title')

<title>Autismo Región de Murcia - Home</title>
@php
    $asociaciones = App\Models\Asociacion::orderBy('nombre', 'asc')->get();
    $noticias = App\Models\Noticia::orderBy('created_at', 'desc')->take(3)->get();
    $recursos = App\Models\Recurso::orderBy('created_at', 'desc')->take(3)->get();
    $etiquetas = App\Models\Etiqueta::orderBy('nombre', 'asc')->get();
@endphp

<style>
    #asociaciones-container {
        -ms-overflow-style: none;  /* Eliminar barra de desplazamiento en IE y Edge */
        scrollbar-width: none;     /* Eliminar barra de desplazamiento en Firefox */
        scroll-behavior: smooth;
        white-space: nowrap;
        overflow: hidden;
    }

    #asociaciones-container::-webkit-scrollbar {
        display: none;             /* Eliminar barra de desplazamiento en Chrome, Safari y Opera */
    }

    .asociacion-item {
        transition: transform 0.3s ease-in-out; /* Animación de transición */
    }


</style>

@stop

@section('content')

<div class="contenido">
    <div class="row">
        <h1 class="text-center my-5 col-12 text-decoration-underline">Autismo Región de Murcia</h1>
        <div class="col-12 col-md-6 order-2 order-md-1 ck-content">
            {!! $parrafo1 !!}
            <br>
            <div class="text-center m-2">
                <a href="{{ route('queesarm') }}"><button class="btn btn-more">Más información</button></a>
            </div>
        </div>
        <div class="col-12 col-md-6 order-1 order-md-2 text-center">
            <img src="{{ asset('assets/img/palma_autismo.jpg') }}" alt="Autismo" class="img-fluid" style="width: 30rem;">
        </div>
    </div>
    <hr>
    <div class="row">
        <h2 class=" text-center my-5 col-12">¿Qué es el autismo?</h2>
        <div class="col-12 col-md-6 text-center">
            <figure>
                <img src="{{ asset('assets/img/infinite-7846410_1280.png') }}" alt="Autismo" class="img-fluid" style="width: 25rem;">
                <figcaption class="text-center mt-2">Somos Infinitos</figcaption>
            </figure>
        </div>
        <div class="col-12 col-md-6 ck-content">
            {!! $parrafo2 !!}
            <br>
            <div class="text-center m-2">
                <a href="{{ route('autismo') }}"><button class="btn btn-more">Más información</button></a>
            </div>
        </div>
    </div>
    <hr>
    <div class="container">
        <div class="text-center my-5">
            <h2>Asociaciones de Trastorno del Espectro Autista<br>en la Región de Murcia</h2>
        </div>
        <div class="d-flex justify-content-between align-items-center my-2 position-relative">
            <!-- Botón Izquierdo -->
            <button id="prev-btn" class="btn btn-more position-absolute" style="left: 0; z-index: 1;">&#10094;</button>

            <!-- Contenedor de asociaciones -->
            <div id="asociaciones-container" class="d-flex overflow-hidden position-relative" style="scroll-behavior: smooth; width: 100%;">
                <!-- Tarjetas de asociaciones -->
                @foreach ($asociaciones as $asociacion)
                    <div class="asociacion-item col-12 col-md-6 col-lg-4" style="display: inline-block; flex: 0 0 auto; padding: 0 15px;">
                        <div class="card border-more" style="width: 100%;">
                            <a href="https://{{ $asociacion->web }}" class="btn" target="_blank">
                                <img src="{{ asset($asociacion->logo ) }}" alt="{{ $asociacion->nombre }}" class="img-fluid" style="text-align: center; height: 200px;">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Botón Derecho -->
            <button id="next-btn" class="btn btn-more position-absolute" style="right: 0; z-index: 1;">&#10095;</button>
        </div>
        <div class="text-center my-3">
            <a href="{{ route('asociaciones') }}"><button class="btn btn-more">Más información</button></a>
        </div>
    </div>
    <hr>
    <div>
        <h2 class=" text-center my-5">Noticias recientes</h2>
        <div class="row my-2">
            @foreach ($noticias as $noticia)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card border-more">
                        <h3 class="card-header" style="background-color:rgb(95, 140, 207);">{{ $noticia->titulo }}</h3>
                        <div class="card-body d-flex justify-content-between align-items-center" style="background-color:rgb(255, 255, 255);">
                            <p class="card-text mb-0"><strong>{{ \Carbon\Carbon::parse($noticia->fecha)->format('d/m/Y') }}</strong></p>
                            <a class="btn btn-more" href="https://{{ $noticia->url }}" target="_blank">Ver noticia</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center my-3">
            <a href="{{ route('noticias') }}"><button class="btn btn-more">Más noticias</button></a>
        </div>
    </div>
    <hr>
    <div>
        <h2 class="text-center my-5">Recursos recientes</h2>
        <div class="row my-2">
            @foreach ($recursos as $recurso)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card border-more">
                        <h3 class="card-header" style="background-color:rgb(95, 140, 207);">{{ $recurso->titulo }}</h3>
                        <div class="card-body d-flex justify-content-between align-items-center" style="background-color:rgb(255, 255, 255);">
                            <p class="card-text mb-0"><strong>{{ $recurso->descripcion }}</strong></p>
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
        <br>
        <div class="text-center my-3">
            <a href="{{ route('recursos') }}"><button class="btn btn-more">Más recursos</button></a>
        </div>
    </div>
</div>

<script>

$(document).ready(function() {

    const $container = $('#asociaciones-container');
    const $prevBtn = $('#prev-btn');
    const $nextBtn = $('#next-btn');

    let cardWidth = $('.asociacion-item').outerWidth();
    let cardsPerClick = getCardsPerClick();
    let scrollAmount = cardWidth * cardsPerClick;

    function getCardsPerClick() {
        const screenWidth = $(window).width();
        if (screenWidth >= 1200) {
            return 3;
        } else if (screenWidth >= 768) {
            return 2;
        } else {
            return 1;
        }
    }

    $nextBtn.click(function() {
        scrollNext();
    })
    $prevBtn.click(function() {
        scrollPrev();
    });

    function scrollNext() {
        const maxScrollLeft = $container[0].scrollWidth - $container[0].clientWidth;

        $container.scrollLeft($container.scrollLeft() + scrollAmount);

        if ($container.scrollLeft() >= maxScrollLeft) {
            $container.scrollLeft(0);
        }
    }

    function scrollPrev() {
        $container.scrollLeft($container.scrollLeft() - scrollAmount);

        if ($container.scrollLeft() <= 0) {
            $container.scrollLeft($container[0].scrollWidth - $container[0].clientWidth);
        }
    }

    $(window).on('resize', function() {
        cardWidth = $('.asociacion-item').outerWidth();
        cardsPerClick = getCardsPerClick();
        scrollAmount = cardWidth * cardsPerClick;
    });
})

</script>

@stop
