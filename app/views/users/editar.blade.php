@extends('layouts.main')
 
@section('contenido')
{{ Form::open(array('url'=>'users/update/'.$user->id, 'method' => 'put')) }}
<div class="tbl_izq">
    <h1>Editar Usuario</h1>
    <ul class="labelreg3">
        <li>Nombre:</li>
        <li>Apellidos:</li>
        <li>Mail:</li>
        <li>Permisos</li>
    </ul>

<ul class="labelreg3">
 	<li>{{ Form::text('firstname', $user->firstname) }}</li>
        <li>{{ Form::text('lastname', $user->lastname) }}</li>
        <li>{{ Form::text('email', $user->email) }}</li>
        <li>{{Form::select('group_id', $usergroups)}}  
        
    <br>
    <li>{{ Form::submit('Guardar cambios')}}</li>
    <li>{{--{{ Form::button('Atrás', array('class'=>'botonl'))}}--}}
</ul>
    
{{ Form::close() }}


@stop
