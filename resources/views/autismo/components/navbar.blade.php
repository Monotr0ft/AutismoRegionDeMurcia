<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand me-5" href="{{ route('home') }}">
            <img src="{{ asset('assets\img\Murcia_-_Mapa_municipal prueba.svg') }}" alt="Logo" width="100" height="100">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item px-3 h4">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ route('home') }}">Inicio</a>
                </li>
                <li class="nav-item px-3 h4">
                    <a class="nav-link {{ Request::is('queesarm') ? 'active' : '' }}" href="{{ route('queesarm') }}">¿Qué es Autismo Región de Murcia?</a>
                </li>
                <li class="nav-item px-3 h4">
                    <a class="nav-link {{ Request::is('autismo') ? 'active' : '' }}" href="{{ route('autismo') }}">¿Qué es el Autismo?</a>
                </li>
                <li class="nav-item px-3 h4">
                    <a class="nav-link {{ Request::is('asociaciones') ? 'active' : '' }}" href="{{ route('asociaciones') }}">Asociaciones TEA Murcia</a>
                </li>
                <li class="nav-item px-3 h4">
                    <a class="nav-link {{ Request::is('recursos') ? 'active' : '' }}" href="{{ route('recursos') }}">Recursos</a>
                </li>
                <li class="nav-item px-3 h4">
                    <a class="nav-link {{ Request::is('noticias') ? 'active' : '' }}" href="{{ route('noticias') }}">Noticias</a>
                </li>
                <li class="nav-item px-3 h4">
                    <a class="nav-link {{ Request::is('contacto') ? 'active' : '' }}" href="{{ route('contacto') }}">Contacto</a>
                </li>
            </ul>
        </div>
    </div>
</nav>