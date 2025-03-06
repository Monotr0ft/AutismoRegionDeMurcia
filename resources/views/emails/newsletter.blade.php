<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter ARM</title>
    @include ('favicon.index')
    @include ('bootstrap.css')
</head>
<body style="box-sizing: border-box; position: relative; -webkit-text-size-adjust: none; color: #718096; height: 100%; line-height: 1.4; width: 100% !important; margin: 0; padding: 0; border: 1px solid #edf2f7;">
    <header class="text-center py-3"></header>
        <img src="{{ asset('assets/img/Murcia_-_Mapa_municipal.jpg') }}" alt="Logo de ARM" class="img-fluid" style="height: 75px; width: 75px;">
    </header>
    <main class="container-fluid bg-white rounded shadow-sm" style="width: 570px; margin: 0 auto; border: 1px solid #e8e5ef;">
        @yield ('content')
    </main>
    @include ('bootstrap.script')
    <footer class="text-center" style="width: 570px; margin: 0 auto;">
        Si quieres dejar de recibir correos electrónicos de ARM, puedes hacerlo pulsando <a href="{{ route('newsletter.unsubscribe', $token) }}" class="text-muted text-decoration-underline">aquí</a>.
    </footer>
</body>
</html>