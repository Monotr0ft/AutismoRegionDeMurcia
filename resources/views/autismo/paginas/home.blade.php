@extends('autismo.index')

@section('title')

<title>Autismo Región de Murcia - Home</title>

@stop

@section('content')

<div>
    <div class="row">
        <h1 class="text-center my-5 col-12 text-decoration-underline">Autismo Región de Murcia</h1>
        <div class="col-12 col-md-6 order-2 order-md-1">
            <p class="justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere ipsum ex dolores ut debitis, quod, aliquam sunt, praesentium maxime nulla repudiandae vero numquam quisquam suscipit adipisci dignissimos mollitia harum! Officia.
            Porro at numquam cum exercitationem pariatur adipisci ullam, repellat iusto aliquam est eius ducimus maxime harum sed possimus voluptatum labore vero ex perferendis expedita assumenda excepturi, magnam omnis! Praesentium, dolore?
            Ut possimus hic cum saepe deleniti vitae sed, deserunt quaerat impedit id voluptatum commodi? Soluta pariatur perspiciatis quasi a blanditiis inventore iure? Placeat recusandae nesciunt quidem dolore provident excepturi cumque?</p>
            <div class="text-center m-2">
                <a href="#"><button class="btn btn-primary">Más información</button></a>
            </div>
        </div>
        <div class="col-12 col-md-6 order-1 order-md-2 text-center">
            <img src="{{ asset('assets/img/palma_autismo.jpg') }}" alt="Autismo" class="img-fluid" style="width: 30rem;">
        </div>
    </div>
    <div class="row">
        <h2 class="text-center my-5 col-12">¿Qué es el autismo?</h2>
        <div class="col-12 col-md-6 text-center">
            <img src="#" alt="Autismo" class="img-fluid" style="border: black 3px solid;">
        </div>
        <div class="col-12 col-md-6">
            <p class="justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere ipsum ex dolores ut debitis, quod, aliquam sunt, praesentium maxime nulla repudiandae vero numquam quisquam suscipit adipisci dignissimos mollitia harum! Officia.
            Porro at numquam cum exercitationem pariatur adipisci ullam, repellat iusto aliquam est eius ducimus maxime harum sed possimus voluptatum labore vero ex perferendis expedita assumenda excepturi, magnam omnis! Praesentium, dolore?
            Ut possimus hic cum saepe deleniti vitae sed, deserunt quaerat impedit id voluptatum commodi? Soluta pariatur perspiciatis quasi a blanditiis inventore iure? Placeat recusandae nesciunt quidem dolore provident excepturi cumque?</p>
            <div class="text-center m-2">
                <a href="#"><button class="btn btn-primary">Más información</button></a>
            </div>
        </div>
    </div>
    <div>
        <div class="text-center my-5">
            <h2>Asociaciones de Trastorno del Espectro Autista<br>en la Región de Murcia</h2>
        </div>
        <div class="text-center my-3">
            <a href="{{ route('asociaciones') }}"><button class="btn btn-primary">Más información</button></a>
        </div>
    </div>
    <div>
        <h2 class="text-center my-5">Noticias recientes</h2>
        <div class="row my-2">

        </div>
        <div class="text-center my-3">
            <a href="#"><button class="btn btn-primary">Más noticias</button></a>
        </div>
    </div>
</div>

@stop
