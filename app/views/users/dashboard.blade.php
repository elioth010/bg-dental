@extends('layouts.main')

@section('contenido')
<h1>Gestión de usuarios:</h1>
 
<p>{{ HTML::link('users/register', 'Nuevo usuario.') }}</p>
Grupos: Administrador: 1, Usuario: 2, Viewer: 3</p>
-----------------------------------------------------<p>
@foreach($users as $user)
    Nombre: {{$user->firstname}}, {{$user->lastname}}<p>
    Mail: {{$user->email}}<p>
    Grupo: {{$user->group_id}}<p>
    
-----------------------------------------------------<p><p>

@endforeach

@stop