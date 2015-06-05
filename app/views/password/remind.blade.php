@extends('layouts.loginmain')

@section('contenido')

<form action="{{ action('RemindersController@store') }}" method="POST">
    <br><br>Correo elctrónico: <input type="email" name="email">
    <input type="submit" value="Enviar mail de reconfiguración">
</form>
@stop