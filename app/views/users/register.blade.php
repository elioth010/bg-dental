@extends('layouts.main')

@section('javascripts')
    <script src="/js/bgdental.js"></script>
@stop

@section('contenido')
{{ Form::open(array('url'=>'users/create', 'class'=>'form-signup')) }}
<h2 class="form-signup-heading">Registre un nuevo usuario</h2>
<ul>
    @foreach($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</ul>

<ul class="labelreg">
	<li>{{ Form::label ('firstname', 'Nombre') }}</li>
    <li>{{ Form::label('lastname', 'Apellidos') }}</li>
    <li>{{ Form::label('email', 'Correo electrónico') }}</li>
    <li>{{ Form::label('password', 'Contraseña') }}</li>
    <li>{{ Form::label('password_confirmation', 'Repita la contraseña') }}</li>
    <li>Permisos</li>
    <li>Sedes</li>
</ul>

<ul class="labelreg2">
    <li>{{ Form::text('firstname', null, array('class'=>'input-block-level')) }}  </li>
    <li>{{ Form::text('lastname', null, array('class'=>'input-block-level')) }} </li>
    <li>{{ Form::text('email', null, array('class'=>'input-block-level')) }}   </li>
    <li>{{ Form::password('password', array('class'=>'input-block-level')) }}   </li>
    <li>{{ Form::password('password_confirmation', array('class'=>'input-block-level')) }}</li>
    <li>{{ Form::select('group_id', $usergroups) }}
    @foreach($sedes as $sede)
    <div>{{ Form::checkbox('sede-'.$sede->id, 1) }} {{$sede->nombre}}</div>
    @endforeach
    <li>{{ Form::submit('Registrar usuario', array('class'=>'botonl'))}}</li>
</ul>

{{ Form::close() }}

<script type="text/javascript">
    $(document).ready(function() {
        initSelectSedes();
    });
</script>

@stop
