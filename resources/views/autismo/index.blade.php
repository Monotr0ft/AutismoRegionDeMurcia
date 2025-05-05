<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')
    @include ('favicon.index')
    @include('bootstrap.css')
    @include('jquery.script')
    <link rel="stylesheet" href="{{ asset('assets/css/autismo.css') }}">
    <script src="{{ asset('assets/js/cookies.js') }}"></script>
    <style>
        .modal-dialog-centered {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
    </style>
</head>
<body>
    @include('autismo.components.navbar')
    <main class="container-fluid contenido">
        @yield('content')
    </main>
    @include('autismo.components.footer')
    @include('bootstrap.script')
    <div class="modal fade" id="cookiesModal" tabindex="-1" role="dialog" aria-labelledby="cookiesModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cookiesModalLabel">Uso de Cookies</h5>
                </div>
                <div class="modal-body">
                    Este sitio web utiliza cookies para mejorar su experiencia. ¿Acepta el uso de cookies?
                    <hr>
                    <form class="acceptCookiesForm" method="POST" action="{{ route('accept.cookies') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">Aceptar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
