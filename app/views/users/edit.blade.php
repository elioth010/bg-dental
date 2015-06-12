@extends('layouts.main')

@section('title')
    Usuarios
@stop

@section('javascripts')
    <script src="/js/bgdental.js"></script>
@stop

@section('contenido')
{{ Form::open(array('url'=>'users/update/'.$user->u_id, 'method' => 'put')) }}

<h1>Editar Usuario</h1>
    <ul class="labelreg5">
        <li>Nombre:</li>
        <li>Apellidos:</li>
        <li>Correo electrónico:</li>
        <li>Permisos:</li>
        <li>Sedes:</li>
    </ul>

    <ul class="labelreg5">
        <li>{{ Form::text('firstname', $user->firstname) }}</li>
        <li>{{ Form::text('lastname', $user->lastname) }}</li>
        <li>{{ Form::text('email', $user->email) }}</li>
        <li>{{ Form::select('group_id', $usergroups, $user->group_id) }}</li>
        @foreach($sedes as $sede)
        <div>{{ Form::checkbox('sede-'.$sede->id, 1, in_array($sede->id, $sedes_pid)) }} {{$sede->nombre}}</div>
        @endforeach
        <li>{{ Form::submit('Guardar cambios')}}</li>
        <li>{{--{{ Form::button('Atrás', array('class'=>'botonl'))}}--}}
    </ul>

{{ Form::close() }}

<script type="text/javascript">
    $(document).ready(function() {
        initSelectSedes();
    });
</script>

@stop
