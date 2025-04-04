<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    @yield ('title')
</head>
<body style="margin: 0; padding: 0; box-sizing: border-box; -webkit-text-size-adjust: none; color: #718096; line-height: 1.4; width: 100%; height: 100%; border: 1px solid #edf2f7; overflow-x: hidden;">
    <header style="text-align: center; padding-top: 1rem; padding-bottom: 1rem;">
        <img src="{{ asset('assets/img/Murcia_-_Mapa_municipal.svg') }}" alt="Logo de ARM" style="height: 75px; width: 75px; max-width: 100%;">
    </header>
    
    <main style="background: #ffffff; border: 1px solid #e8e5ef; border-radius: 5px; width: 100%; max-width: 570px; margin: 0 auto; padding: 20px;">
        @yield('content')
    </main>
    
    <footer style="width: 100%; max-width: 570px; margin: 0 auto; padding: 15px 10px; text-align: center; box-sizing: border-box;">
        @yield ('footer')
    </footer>
</body>
</html>