<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')
    @include('bootstrap.index')
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
</head>
<body class="container-fluid">
    @include('arba.dashboard.nav')
    @yield('content')
</body>
</html>