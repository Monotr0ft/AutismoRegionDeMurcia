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
                    <a href="{{ route('asociaciones.create') }}" class="nav-link p-0 text-muted">Solicitar Asociación</a>
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
                    <!-- Cookies -->
                    <a href="" class="nav-link p-0 text-muted" data-bs-toggle="modal" data-bs-target="#explainCookiesModal">Cookies</a>
                </li>
                <li class="nav-item mb-2">
                    <!-- Política de privacidad -->
                    <a href="" class="nav-link p-0 text-muted" data-bs-toggle="modal" data-bs-target="#privacyModal">Política de privacidad</a>
                </li>
                <li class="nav-item mb-2">
                    <!-- Seguridad y protección -->
                    <a href="" class="nav-link p-0 text-muted" data-bs-toggle="modal" data-bs-target="#securityModal">Seguridad y protección</a>
                </li>
            </ul>
        </div>
        <div class="col-12 col-md-2 mb-3">
        </div>
        <div class="col-md-5 offset-md-1 mb-3">
        @if ($errors->has('newsletter_error'))
            <div class="alert alert-danger">
                {{  $errors->first('newsletter_error') }}
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
        <p>© 2025 Monotr0ft. All rights reserved</p>
        <ul class="list-unstyled d-flex">
            <li class="ms-3"></li>
            <li class="ms-3"></li>
            <li class="ms-3"></li>
        </ul>
    </div>
</footer>
</div>
</div>