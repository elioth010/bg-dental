@extends('layouts.main')

@section('contenido')
<h1>Gestión de usuarios:</h1>
{{ HTML::link('users/register', 'Nuevo usuario.') }}
<h3>
  Usuarios:
  </h2>
  
    <table border = "1">
      <tr>
      <th>Nombre
      </th><th>Apellidos
      </th><th>Mail
      </th><th>Permisos
      </th><th>Sede(s)
      </th>
      </tr>
      
      @foreach($users as $user)
        <tr>
        <td>{{ HTML::linkAction('UsersController@getEdit',  $user->firstname, $user->id) }}</td>
        <td> {{$user->lastname}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->nombre_g}}</td>
        <td>{{$user->sedes_p}}</td>
        </tr>
      @endforeach
      
    </table>
@stop