<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensaje de Contacto</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 20px; background-color: #f4f4f4;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        
        <!-- Header -->
        <div style="text-align: center; border-bottom: 3px solid #007bff; padding-bottom: 20px; margin-bottom: 30px;">
            <h1 style="color: #007bff; margin: 0; font-size: 28px;">Nuevo Mensaje de Contacto</h1>
        </div>
        
        <!-- Content -->
        <div style="margin-bottom: 30px;">
            
            <!-- Nombre -->
            <div style="margin-bottom: 20px; padding: 15px; background-color: #f8f9fa; border-left: 4px solid #007bff; border-radius: 5px;">
                <span style="font-weight: bold; color: #495057; margin-bottom: 8px; display: block; font-size: 14px; text-transform: uppercase; letter-spacing: 1px;">Nombre:</span>
                <div style="color: #212529; font-size: 16px;">{{ $nombre }}</div>
            </div>
            
            <!-- Email (solo si existe) -->
            @if(isset($email) && $email)
            <div style="margin-bottom: 20px; padding: 15px; background-color: #f8f9fa; border-left: 4px solid #007bff; border-radius: 5px;">
                <span style="font-weight: bold; color: #495057; margin-bottom: 8px; display: block; font-size: 14px; text-transform: uppercase; letter-spacing: 1px;">Email:</span>
                <div style="color: #212529; font-size: 16px;">
                    <a href="mailto:{{ $email }}" style="color: #007bff; text-decoration: none;">{{ $email }}</a>
                </div>
            </div>
            @endif
            
            <!-- Mensaje -->
            <div style="margin-bottom: 20px; padding: 15px; background-color: #f8f9fa; border-left: 4px solid #007bff; border-radius: 5px;">
                <span style="font-weight: bold; color: #495057; margin-bottom: 8px; display: block; font-size: 14px; text-transform: uppercase; letter-spacing: 1px;">Mensaje:</span>
                <div style="color: #212529; font-size: 16px;">
                    <div style="background-color: #fff; padding: 20px; border: 1px solid #dee2e6; border-radius: 5px; white-space: pre-wrap; line-height: 1.8;">{{ $mensaje }}</div>
                </div>
            </div>
            
        </div>
        
        <!-- Footer -->
        <div style="text-align: center; padding-top: 20px; border-top: 1px solid #dee2e6; color: #6c757d; font-size: 14px;">
            <p style="margin: 5px 0;">Este mensaje fue enviado desde el formulario de contacto de tu sitio web.</p>
            <p style="margin: 5px 0;"><strong>Fecha:</strong> {{ date('d/m/Y H:i:s') }}</p>
        </div>
        
    </div>
</body>
</html>