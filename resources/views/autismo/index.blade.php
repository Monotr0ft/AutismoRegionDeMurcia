<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')
    @include('bootstrap.index')
</head>
<body>
    @include('autismo.components.navbar')
    @yield('content')
    @include('autismo.components.footer')
</body>
</html>
