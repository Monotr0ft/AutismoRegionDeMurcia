<nav class="navbar mx-3">
    <a href="{{ route('dashboard') }}" class="text-decoration-none"><h1>Dashboard</h1></a>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-outline-danger">Cerrar sesión</button>
    </form>
</nav>