@extends('layouts.main')
 
@section('contenido')
{{ Form::open(array('url'=>'users/create', 'class'=>'form-signup')) }}
    <h2 class="form-signup-heading">Registre un nuevo usuario</h2>
 
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
 
     {{ Form::label('firstname', 'Nombre') }}
     {{ Form::text('firstname', null, array('class'=>'input-block-level', 'placeholder'=>'First Name')) }}<br>
     {{ Form::label('lastname', 'Apellidos') }}
    {{ Form::text('lastname', null, array('class'=>'input-block-level', 'placeholder'=>'Last Name')) }}<br>
     {{ Form::label('email', 'Correo electrónico') }}
    {{ Form::text('email', null, array('class'=>'input-block-level', 'placeholder'=>'Email Address')) }}<br>
     {{ Form::label('password', 'Contraseña') }}
    {{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password')) }}<br>
     {{ Form::label('password_confirmation', 'Repita la contraseña') }}
    {{ Form::password('password_confirmation', array('class'=>'input-block-level', 'placeholder'=>'Confirm Password')) }}<br>
 
    {{ Form::submit('Registrar usuario', array('class'=>'btn btn-large btn-primary btn-block'))}}
{{ Form::close() }}
@stop
