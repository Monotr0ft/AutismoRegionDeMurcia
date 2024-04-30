<nav class="navbar navbar-expand-lg navbar-light">
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
                    <a class="nav-link" href="{{ route('home') }}">Inicio</a>
                </li>
                <li class="nav-item px-3 h4">
                    <a class="nav-link" href="#">¿Qué es Autismo Región de Murcia?</a>
                </li>
                <li class="nav-item px-3 h4">
                    <a class="nav-link" href="{{ route('asociaciones') }}">Asociaciones TEA Murcia</a>
                </li>
                <li class="nav-item px-3 h4">
                    <a class="nav-link" href="#">Recursos</a>
                </li>
                <li class="nav-item px-3 h4">
                    <a class="nav-link" href="#">Noticias</a>
                </li>
                <li class="nav-item px-3 h4 dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Usuario
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        @if (Auth::check())
                            <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Cerrar sesión</button>
                                </form>
                            </li>
                        @else
                            <li><a class="dropdown-item" href="{{ action([\App\Http\Controllers\UserController::class, 'getLogin']) }}">Iniciar sesión</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>