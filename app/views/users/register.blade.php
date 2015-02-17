@extends('layouts.main')
 
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
     <li>{{Form::select('group_id', $usergroups)}}
  	</ul>
	 
	<ul class="labelreg2"> 
     <li>{{ Form::text('firstname', null, array('class'=>'input-block-level', 'placeholder'=>'First Name')) }}  </li>   
     <li>{{ Form::text('lastname', null, array('class'=>'input-block-level', 'placeholder'=>'Last Name')) }} </li>
     <li>{{ Form::text('email', null, array('class'=>'input-block-level', 'placeholder'=>'Email Address')) }}   </li>  
     <li>{{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password')) }}   </li>
     <li>{{ Form::password('password_confirmation', array('class'=>'input-block-level', 'placeholder'=>'Confirm Password')) }}</li>
	<li>{{ Form::submit('Registrar usuario', array('class'=>'botonl'))}}</li>
    </ul>

{{ Form::close() }}
@stop
