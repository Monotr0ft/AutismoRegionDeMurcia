@extends('autismo.index')

@section('title')

<title>Autismo Región de Murcia - Home</title>
@php
    $asociaciones = App\Models\Asociacion::orderBy('nombre', 'asc')->get();
    $noticias = App\Models\Noticia::orderBy('created_at', 'desc')->take(3)->get();
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

<div>
    <div class="row">
        <h1 class="text-center my-5 col-12 text-decoration-underline">Autismo Región de Murcia</h1>
        <div class="col-12 col-md-6 order-2 order-md-1">
            <p class="justify ">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere ipsum ex dolores ut debitis, quod, aliquam sunt, praesentium maxime nulla repudiandae vero numquam quisquam suscipit adipisci dignissimos mollitia harum! Officia.
            Porro at numquam cum exercitationem pariatur adipisci ullam, repellat iusto aliquam est eius ducimus maxime harum sed possimus voluptatum labore vero ex perferendis expedita assumenda excepturi, magnam omnis! Praesentium, dolore?
            Ut possimus hic cum saepe deleniti vitae sed, deserunt quaerat impedit id voluptatum commodi? Soluta pariatur perspiciatis quasi a blanditiis inventore iure? Placeat recusandae nesciunt quidem dolore provident excepturi cumque?</p>
            <div class="text-center m-2">
                <a href="{{ route('queesarm') }}"><button class="btn btn-more">Más información</button></a>
            </div>
        </div>
        <div class="col-12 col-md-6 order-1 order-md-2 text-center">
            <img src="{{ asset('assets/img/palma_autismo.jpg') }}" alt="Autismo" class="img-fluid" style="width: 30rem;">
        </div>
    </div>
    <div class="row">
        <h2 class=" text-center my-5 col-12">¿Qué es el autismo?</h2>
        <div class="col-12 col-md-6 text-center">
            <img src="#" alt="Autismo" class="img-fluid" style="border: black 3px solid;">
        </div>
        <div class="col-12 col-md-6">
            <p class="justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere ipsum ex dolores ut debitis, quod, aliquam sunt, praesentium maxime nulla repudiandae vero numquam quisquam suscipit adipisci dignissimos mollitia harum! Officia.
            Porro at numquam cum exercitationem pariatur adipisci ullam, repellat iusto aliquam est eius ducimus maxime harum sed possimus voluptatum labore vero ex perferendis expedita assumenda excepturi, magnam omnis! Praesentium, dolore?
            Ut possimus hic cum saepe deleniti vitae sed, deserunt quaerat impedit id voluptatum commodi? Soluta pariatur perspiciatis quasi a blanditiis inventore iure? Placeat recusandae nesciunt quidem dolore provident excepturi cumque?</p>
            <div class="text-center m-2">
                <a href="{{ route('autismo') }}"><button class="btn btn-more">Más información</button></a>
            </div>
        </div>
    </div>
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
                        <div class="card" style="width: 100%;">
                            <div class="card-header d-flex justify-content-around align-items-center" style="background-color: #788AA3;">
                                <img src="{{ asset($asociacion->logo ) }}" alt="{{ $asociacion->nombre }}" class="img-fluid" style="height: 200px;">
                            </div>
                            <div class="card-body text-center" style="background-color: #CCCCCC;">
                                <h3>{{ $asociacion->nombre }}</h3>
                                <a href="https://{{ $asociacion->web }}" class="btn btn-more">Ver más</a>
                            </div>
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
    <div>
        <h2 class=" text-center my-5">Noticias recientes</h2>
        <div class="row my-2">
            @foreach ($noticias as $noticia)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card">
                        <h3 class="card-header" style="background-color: #788AA3;">{{ $noticia->titulo }}</h3>
                        <div class="card-body" style="background-color: #CCCCCC;">
                            <a class="btn btn-more" href="https://{{ $noticia->url }}">Ver noticia</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center my-3">
            <a href="{{ route('noticias') }}"><button class="btn btn-more">Más noticias</button></a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    const container = document.getElementById('asociaciones-container');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');

    let cardWidth = document.querySelector('.asociacion-item').offsetWidth; // Ancho inicial de una tarjeta
    let cardsPerClick = getCardsPerClick(); // Determinar cuántas tarjetas mostrar por clic según el tamaño de pantalla
    let scrollAmount = cardWidth * cardsPerClick; // Cantidad de píxeles a desplazar

    // Ajustar el número de tarjetas por clic según el tamaño de pantalla
    function getCardsPerClick() {
        const screenWidth = window.innerWidth;
        if (screenWidth >= 1200) {
            return 3;  // Pantallas grandes (tres tarjetas)
        } else if (screenWidth >= 768) {
            return 2;  // Pantallas medianas (dos tarjetas)
        } else {
            return 1;  // Pantallas pequeñas (una tarjeta)
        }
    }

    // --- Desplazamiento con botones ---
    nextBtn.addEventListener('click', () => {
        scrollNext();
    });

    prevBtn.addEventListener('click', () => {
        scrollPrev();
    });

    // --- Función para desplazarse hacia la derecha ---
    function scrollNext() {
        const maxScrollLeft = container.scrollWidth - container.clientWidth;

        container.scrollLeft += scrollAmount; // Desplazar el número de tarjetas según la pantalla

        if (container.scrollLeft >= maxScrollLeft) {
            container.scrollLeft = 0; // Scroll infinito, volver al inicio
        }
    }

    // --- Función para desplazarse hacia la izquierda ---
    function scrollPrev() {
        container.scrollLeft -= scrollAmount; // Desplazar el número de tarjetas según la pantalla

        if (container.scrollLeft <= 0) {
            container.scrollLeft = container.scrollWidth - container.clientWidth; // Scroll infinito, volver al final
        }
    }

    // --- Recalcular el tamaño de las tarjetas y el desplazamiento cuando la ventana se redimensiona ---
    window.addEventListener('resize', () => {
        cardWidth = document.querySelector('.asociacion-item').offsetWidth;
        cardsPerClick = getCardsPerClick(); // Recalcular cuántas tarjetas mostrar según el tamaño de pantalla
        scrollAmount = cardWidth * cardsPerClick;
    });
});
</script>

@stop
