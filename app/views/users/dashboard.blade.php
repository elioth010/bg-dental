@extends('layouts.main')

@section('contenido')
<h1>Gestión de usuarios:</h1>
 
<p>{{ HTML::link('users/register', 'Nuevo usuario.') }}</p>
Grupos:<p>Administrador: 1, Usuario: 2, Viewer: 3</p>
@foreach($users as $user)
    {{$user->firstname}}, {{$user->lastname}}<p>
    {{$user->email}}<p>
        {{$user->group_id}}<p>
-----------------------------------------------------<p><p>
@endforeach

@stop