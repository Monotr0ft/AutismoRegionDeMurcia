<x-mail::message>

    <x-mail::header>
        <x-mail::title>
            Bienvenido a ARBA
        </x-mail::title>
    </x-mail::header>

    <x-mail::body>
        <p>
            Hola {{ $nombre }} {{ $apellidos }}.
        </p>
        <p>
            Se le ha añadido a ARBA como usuario para acceder a la plataforma.
        </p>
        <p>
            Su contraseña es: <strong>{{ $password }}</strong>. Recuerde cambiarla en su primer inicio de sesión. Para cambiarla, inicie sesión en la plataforma y vaya a su perfil. Ahí, podrá cambiar su contraseña.
        </p>
        <p>
            Esperemos que tenga una buena experiencia en la plataforma.
        </p>
    </x-mail::body>

    <x-mail::footer>
        <x-mail::signature>
            Arba
        </x-mail::signature>
    </x-mail::footer>

</x-mail::message>
