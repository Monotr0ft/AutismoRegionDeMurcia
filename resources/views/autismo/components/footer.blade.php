<footer class="row">
    <div class="col-12 col-md-3 d-flex flex-column justify-content-center align-items-center">
        <a href="#">Mapa web</a>
        <a href="#"></a>
    </div>
    <div class="col-12 col-md-3 d-flex flex-column justify-content-center align-items-center">
        <a href="#">Ajustes de cookies</a>
        <a href="#">Politica de privacidad</a>
    </div>
    <div class="col-12 col-md-3 d-flex flex-column justify-content-center align-items-center">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @elseif (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <form action="{{ route('newsletter') }}" method="post" class="text-center" style="background-color: whitesmoke; border: 2px solid black; padding: 0 10px; border-radius: 10px">
            @csrf
            <div class="form-group">
                <h4 for="email" class="m-3">Suscribete a nuestra newsletter</h4>
                <input type="email" name="email" id="email" class="form-control" placeholder="Introduce tu email">
            </div>
            <input type="submit" value="Enviar" class="btn btn-outline-secondary">
        </form>
    </div>
    <div class="col-12 col-md-3 d-flex flex-column justify-content-center align-items-center">
        <p>Monotr0ft</p>
    </div>
</footer>