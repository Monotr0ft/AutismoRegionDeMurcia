<nav class="navbar mx-3">
    <a href="{{ route('dashboard.arba') }}" class="text-decoration-none"><h1>Dashboard</h1></a>
    <div class="d-flex">
        <a href="{{ route('arba.perfil') }}" class="btn btn-outline-primary m-3">Perfil</a>
        <form method="POST" action="{{ route('arba.logout') }}" class="m-3">
            @csrf
            <button type="submit" class="btn btn-outline-danger">Cerrar sesión</button>
        </form>
    </div>
</nav>
