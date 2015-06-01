@extends('layouts.main')

@section('contenido')
<h1>Gestión de usuarios:</h1>
{{ HTML::link('users/register', 'Dar de alta un nuevo usuario.') }}

<h2>Usuarios:</h2>

    <table border="1">
      <tr>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>E-Mail</th>
        <th>Permisos</th>
        <th>Sede(s)</th>
      </tr>

      @foreach($users as $user)
      <tr>
        <td>{{ HTML::linkAction('UsersController@getEdit', $user->firstname, $user->user_id) }}</td>
        <td>{{ $user->lastname }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->nombre_g }}</td>
        <td>{{ $sedes[$user->id] or '' }}</td>
      </tr>
      @endforeach

    </table>
@stop
