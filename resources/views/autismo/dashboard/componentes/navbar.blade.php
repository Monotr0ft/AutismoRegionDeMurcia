<script>
    function confirmLogout() {
        return confirm('¿Estás seguro de que quieres cerrar sesión?');
    }
</script>
<nav class="navbar mx-3">
    <a href="{{ route('dashboard') }}" class="text-decoration-none"><h1>Dashboard</h1></a>
    <div class="d-flex align-items-center justify-content-between mx-2">
        <div class="d-flex align-items-center mx-2">
            <img src="{{ asset('assets/img/user.png') }}" alt="user" class="rounded-circle" width="40" height="40">
            <p class="mx-2 my-0"><strong>{{ Auth::user()->name }}</strong></p>
        </div>
        <a href="{{ route('panel') }}" class="btn btn-outline-primary mx-2">Perfil</a>
        <form method="POST" action="{{ route('logout') }}" onclick="return confirmLogout()" class="mx-2">
            @csrf
            <button type="submit" class="btn btn-outline-danger">Cerrar sesión</button>
        </form>
    </div>
</nav>