@extends('layouts.loginmain')

@section('title')
    Entrada
@stop

@section('contenido')

{{ Form::open(array('url'=>'users/signin', 'class'=>'form-signin')) }}
<h2 class="form-signin-heading">Introduce tus datos de usuario </h2>
 	<ul class="labelreg3">
         <li>{{ Form::text('email', null, array('class'=>'input-block-level', 'placeholder'=>'Email Address')) }}</li>
         <li>{{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password')) }}</li>
         <li>{{ Form::submit('Entrar', array('class'=>'botonl'))}}</li>
         <li>{{ HTML::link('password', '¿Olvidó su contraseña...?') }}</li>
     </ul>
{{ Form::close() }}
@stop
