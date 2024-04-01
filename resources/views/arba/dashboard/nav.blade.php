<nav class="navbar mx-3">
    <h1>Dashboard</h1>
    <form method="POST" action="{{ route('arba.logout') }}">
        @csrf
        <button type="submit">Cerrar sesión</button>
    </form>
</nav>
