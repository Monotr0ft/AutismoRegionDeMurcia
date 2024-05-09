<x-mail::message>
# Verificar Email

Hola {{ $nombre }} {{ $apellidos }},

Si has recibido este correo, es porque has solicitado la verificación de tu dirección de correo electrónico en nuestra plataforma.

Por favor, haz clic en el siguiente botón para verificar tu dirección de correo electrónico:

<x-mail::button :url="$url">
Verificar Email
</x-mail::button>

Si no has solicitado la verificación de tu dirección de correo electrónico, puedes ignorar este mensaje.

</x-mail::message>
