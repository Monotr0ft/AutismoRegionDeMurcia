@extends('autismo.index')

@section('title')

    <title>Autismo Región de Murcia - Contacto</title>

@endsection

@section('content')
    
<div class="contenido">
    <div class="my-5 text-center">
        <h1>Contacto</h1>
        <p>Si quieres que pongamos algún recurso que consideres interesante, o comentarnos algo, utiliza este formulario</p>
    </div>
    <div class="row">
        <div class="col-12 col-md-4"></div>
        <div class="col-12 col-md-4">
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <form action="{{ route('contacto.send') }}" id="contactForm" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="subject" class="form-label">Asunto</label>
                    <input type="text" class="form-control" id="subject" name="subject" required>
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="message" class="form-label">Mensaje</label>
                    <textarea class="form-control" id="message" name="message" rows="6" required></textarea>
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email (opcional)</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <br>
                <button type="submit" class="btn btn-primary" id="submitBtn">Enviar</button>
                <br>
                <br>
                <!-- Modal de reCAPTCHA -->
                <div class="modal fade" id="recaptchaModal" tabindex="-1" aria-labelledby="recaptchaModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="recaptchaModalLabel">Verificación de reCAPTCHA</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div id="recaptchaWidget" class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_API') }}" data-callback="recaptchaCallback"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-12 col-md-4"></div>
    </div>
</div>

<script>
    function validateForm() {
        let isValid = true;
        
        // Validar nombre
        const name = $('#name').val().trim();
        if (!name) {
            alert('Por favor, ingresa tu nombre');
            $('#name').focus();
            return false;
        }
        
        // Validar asunto
        const subject = $('#subject').val().trim();
        if (!subject) {
            alert('Por favor, ingresa el asunto');
            $('#subject').focus();
            return false;
        }
        
        // Validar mensaje
        const message = $('#message').val().trim();
        if (!message) {
            alert('Por favor, ingresa tu mensaje');
            $('#message').focus();
            return false;
        }
        
        // Validar email si se proporciona
        const email = $('#email').val().trim();
        if (email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Por favor, ingresa un email válido');
                $('#email').focus();
                return false;
            }
        }
        
        return true;
    }

    function loadRecaptcha() {
        if (typeof grecaptcha !== 'undefined') {
            grecaptcha.ready(() => {
                grecaptcha.render('recaptchaWidget', {
                    sitekey: "{{ env('RECAPTCHA_API') }}",
                    callback: recaptchaCallback
                });
            });
        }
    }

    function recaptchaCallback(response) {
        if (!response) {
            alert('Error: Completa el reCAPTCHA');
            return;
        }

        // Remover input anterior si existe
        $('input[name="g-recaptcha-response"]').remove();
        
        $('#contactForm').append('<input type="hidden" name="g-recaptcha-response" value="' + response + '">');
        $('#recaptchaModal').modal('hide');
        $('#submitBtn').prop('disabled', true).text('Enviando...');
        
        // Enviar formulario
        $('#contactForm')[0].submit();
    }

    $(document).ready(function() {
        // Cargar script de reCAPTCHA
        const script = document.createElement('script');
        script.src = 'https://www.google.com/recaptcha/api.js?onload=loadRecaptcha&render=explicit&hl=es';
        script.async = true;
        script.defer = true;
        document.head.appendChild(script);

        $('#submitBtn').click(function(e) {
            e.preventDefault();
            
            if (validateForm()) {
                $('#recaptchaModal').modal('show');
                
                // Reset reCAPTCHA si ya existe
                if (typeof grecaptcha !== 'undefined') {
                    grecaptcha.reset();
                }
            }
        });
        
        // Manejar cierre del modal
        $('#recaptchaModal').on('hidden.bs.modal', function () {
            $('#submitBtn').prop('disabled', false).text('Enviar');
        });
    });
</script>
</script>

@endsection