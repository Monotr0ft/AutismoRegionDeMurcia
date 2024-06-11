<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')
    @include ('favicon.index')
    @include('bootstrap.css')
    <link rel="stylesheet" href="{{ asset('assets/css/autismo.css') }}">
</head>
<body>
    @include('autismo.components.navbar')
    <main class="container-fluid">
        @yield('content')
    </main>
    @include('autismo.components.footer')
    @include('bootstrap.script')
</body>
</html>
