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
    <!-- Modal de Explicación de Cookies -->
    <div class="modal fade" id="explainCookiesModal" tabindex="-1" role="dialog" aria-labelledby="explainCookiesModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="explainCookiesModalLabel">¿Qué son las Cookies?</h5>
                </div>
                <div class="modal-body">
                    <p>Las cookies son pequeños archivos que se almacenan en su dispositivo para mejorar la experiencia de usuario, recordar preferencias y recopilar información estadística sobre la navegación.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Política de Privacidad -->
    <div class="modal fade" id="privacyModal" tabindex="-1" role="dialog" aria-labelledby="privacyModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="privacyModalLabel">Política de Privacidad</h5>
                </div>
                <div class="modal-body">
                    <p>Esta web respeta y protege los datos personales de los usuarios. Nunca se pedirá información muy personal (DNI, Nombre, etc.) sobre tí.</p>
                    <p>La única información que manejamos es la de Newsletter por el que te suscribes con tu email. Está información solo se usa para enviarte correos sobre cambios en la web, y para nada más.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Seguridad y Protección -->
    <div class="modal fade" id="securityModal" tabindex="-1" role="dialog" aria-labelledby="securityModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="securityModalLabel">Seguridad y Protección</h5>
                </div>
                <div class="modal-body">
                    <p>Toda la información que se almacena en esta web está estrictamente protegida, por lo que es muy difícil que alguien sin permisos entre.</p>
                    <p>Siempre se irá actualizando para seguir dando protección a estos datos, y, sobre todo, a cualquier persona que visite la web.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Aceptación de Cookies -->
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
