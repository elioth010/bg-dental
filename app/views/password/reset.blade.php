@extends('layouts.loginmain')

@section('title')
    Cambiar contraseña
@stop

@section('contenido')
<br> <br>
<form action="{{ action('RemindersController@update') }}" method="POST">
    <input type="hidden" name="token" value="{{ $token }}">
    Correo electrónico: <input type="email" name="email">
    Contraseña: <input type="password" name="password">
    Confirmación de contraseña: <input type="password" name="password_confirmation">
    <input type="submit" value="Cambiar contraseña">
</form>
@stop
