@extends ('autismo.dashboard.index')

@section('title')

    <title>Dashboard Autismo Región de Murcia - Home</title>

@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <h1 class="text-center">Bienvenido al Dashboard de Autismo Región de Murcia</h1>
    </div>
</div>
<br>
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
    @can('gestionar_usuarios')
    <div class="col d-flex align-items-stretch">
        <div class="card" style="width: 100%;">
            <div class="card-header">
                <h2>Usuarios</h2>
            </div>
            <div class="card-body">
                <h4>Gestiona los usuarios de la página web</h4>
                <div class="text-center">
                    <a href="{{ route('dashboard.usuarios') }}" class="btn btn-primary">Ver usuarios</a>
                    <a href="{{ route('dashboard.usuarios.create') }}" class="btn btn-success">Crear nuevo usuario</a>
                </div>
            </div>
        </div>
    </div>
    @endcan
    @can('gestionar_asociaciones')
    <div class="col d-flex align-items-stretch">
        <div class="card" style="width: 100%;">
            <div class="card-header">
                <h2>Asociaciones</h2>
            </div>
            <div class="card-body">
                <h4>Gestiona las asociaciones que existen y las que están por revisar de la página web</h4>
                <div class="text-center">
                    <a href="{{ route('dashboard.asociaciones') }}" class="btn btn-primary">Ver asociaciones</a>
                    <a href="{{ route('dashboard.asociacionesnuevas') }}" class="btn btn-warning">Ver asociaciones nuevas</a>
                </div>
            </div>
        </div>
    </div>
    @endcan
    @can('gestionar_noticias')
    <div class="col d-flex align-items-stretch">
        <div class="card" style="width: 100%;">
            <div class="card-header">
                <h2>Noticias</h2>
            </div>
            <div class="card-body">
                <h4>Gestiona las noticias de la página web</h4>
                <div class="text-center">
                    <a href="{{ route('dashboard.noticias') }}" class="btn btn-primary">Ver noticias</a>
                    <a herf="{{ route('dashboard.noticias.create') }}" class="btn btn-success">Crear nueva noticia</a>
                </div>
            </div>
        </div>
    </div>
    @endcan
    @can('gestionar_paginas')
    <div class="col d-flex align-items-stretch">
        <div class="card" style="width: 100%;">
            <div class="card-header">
                <h2>Páginas</h2>
            </div>
            <div class="card-body">
                <h4>Gestiona las páginas de la página web</h4>
                <div class="text-center">
                    <a href="{{ route('dashboard.paginas') }}" class="btn btn-primary">Ver páginas</a>
                </div>
            </div>
        </div>
    </div>
    @endcan
    @can('gestionar_recursos')
    <div class="col d-flex align-items-stretch">
        <div class="card" style="width: 100%;">
            <div class="card-header">
                <h2>Recursos y etiquetas</h2>
            </div>
            <div class="card-body">
                <h4>Gestiona los recursos y etiquetas de la página web</h4>
                <div class="text-center">
                    <a href="{{ route('dashboard.recursos') }}" class="btn btn-primary">Ver recursos</a>
                    <a href="{{ route('dashboard.etiquetas') }}" class="btn btn-primary">Ver etiquetas</a>
                </div>
            </div>
        </div>
    </div>
    @endcan
    @can('viewAny', App\Models\User::class)
    <div class="col d-flex align-items-stretch">
        <div class="card" style="width: 100%;">
            <div class="card-header">
                <h2>Usuarios</h2>
            </div>
            <div class="card-body">
                <h4>Gestionar los usuarios de la página web</h4>
                <div class="text-center">
                    <a href="{{ route('dashboard.usuarios') }}" class="btn btn-primary">Ver usuarios</a>
                    <a href="{{ route('dashboard.usuarios.create') }}" class="btn btn-success">Crear nuevo usuario</a>
                </div>
            </div>
        </div>
    </div>
    @endcan
</div>

@endsection
