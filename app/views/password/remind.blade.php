@extends('layouts.loginmain')

@section('title')
    Recordar contraseña
@stop

@section('contenido')

<form action="{{ action('RemindersController@store') }}" method="POST">
    <br><br>Correo electrónico: <input type="email" name="email">
    <input type="submit" value="Enviar mail de reconfiguración">
</form>
@stop
