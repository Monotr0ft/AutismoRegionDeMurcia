<x-mail::message>

    <x-mail::header url="">
        Bienvenido a ARBA
    </x-mail::header>

    Hola {{ $nombre }} {{ $apellidos }}.
    
    Se le ha añadido a ARBA como usuario para acceder a la plataforma.

    Su contraseña es: {!! $password !!}. Recuerde cambiarla en su primer inicio de sesión. Para cambiarla, inicie sesión en la plataforma y vaya a su perfil. Ahí, podrá cambiar su contraseña.

    Esperemos que tenga una buena experiencia en la plataforma.

</x-mail::message>
