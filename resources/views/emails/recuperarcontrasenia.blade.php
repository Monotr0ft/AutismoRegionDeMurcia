<x-mail::message>
# Recuperar contraseña

Hola {{ $nombre }} {{ $apellidos }}.

Hemos recibido una solicitud para recuperar tu contraseña. Si no has sido tú, por favor, contacta con el soporte técnico.

<x-mail::button :url="$url">
Recuperar contraseña
</x-mail::button>

</x-mail::message>
