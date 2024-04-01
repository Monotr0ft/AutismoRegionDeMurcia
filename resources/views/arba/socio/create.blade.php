@extends('arba.dashboard')

@section('title')

<title>ARBA - Crear Socio</title>

@stop

@section('content')

<div>
    <h1>Crear Socio</h1>
    <form action="" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
        </div>
        <div class="form-group">
            <label for="apellidos">Apellidos</label>
            <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos">
        </div>
        <div class="form-group">
            <label for="dni">DNI</label>
            <input type="text" class="form-control" name="dni" id="dni" placeholder="DNI">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Teléfono">
        </div>
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Dirección">
        </div>
        <div class="form-group">
            <label for="junta_directiva">Junta Directiva</label>
            <input type="text" class="form-control" name="junta_directiva" id="junta_directiva" placeholder="Junta Directiva">
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
</div>

@stop
