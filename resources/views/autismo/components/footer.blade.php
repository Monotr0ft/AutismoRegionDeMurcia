<div class="pie">
<div class="container">
<footer class="py-5">
    <div class="row">
        <div class="col-6 col-md-2 mb-3">
            <h5>Mapa web</h5>
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a href="{{ route('home') }}" class="nav-link p-0 text-muted">Home</a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('queesarm') }}" class="nav-link p-0 text-muted">¿Qué es Autismo Región de Murcia?</a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('autismo') }}" class="nav-link p-0 text-muted">¿Qué es el Autismo?</a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('asociaciones') }}" class="nav-link p-0 text-muted">Asociaciones TEA Murcia</a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('recursos') }}" class="nav-link p-0 text-muted">Recursos</a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('noticias') }}" class="nav-link p-0 text-muted">Noticias</a>
                </li>
            </ul>
        </div>
        <div class="col-6 col-md-2 mb-3">
            <h5>Cookies y Privacidad</h5>
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a href="#" class="nav-link p-0 text-muted">Cookies</a>
                </li>
                <li class="nav-item mb-2">
                    <a href="#" class="nav-link p-0 text-muted">Política de privacidad</a>
                </li>
                <li class="nav-item mb-2">
                    <a href="#" class="nav-link p-0 text-muted">Seguridad y protección</a>
                </li>
            </ul>
        </div>
        <div class="col-12 col-md-2 mb-3">
        </div>
        <div class="col-md-5 offset-md-1 mb-3">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @elseif (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <form action="{{ route('newsletter') }}" method="post">
            @csrf
            <h5>Suscríbete a nuestra newsletter</h5>
            <p>Recibe toda la información que se añada a nuestra página</p>
            <div class="d-flex flex-column flex-sm-row w-100 gap-2">
                <label for="email" class="visually-hidden">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                <button type="submit" class="btn btn-submit">Enviar</button>
            </div>
        </form>
    </div>
    </div>
    <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top">
        <p>© 2024 Monotr0ft. All rights reserved</p>
        <ul class="list-unstyled d-flex">
            <li class="ms-3"></li>
            <li class="ms-3"></li>
            <li class="ms-3"></li>
        </ul>
    </div>
</footer>
</div>
</div>