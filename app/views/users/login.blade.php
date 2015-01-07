@extends('layouts.loginmain')
 
@section('contenido')

{{ Form::open(array('url'=>'users/signin', 'class'=>'form-signin')) }}
    <h2 class="form-signin-heading">Introduce tus datos de usuario </h2>
 
    {{ Form::text('email', null, array('class'=>'input-block-level', 'placeholder'=>'Email Address')) }}
    {{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password')) }}
 
    {{ Form::submit('Entrar', array('class'=>'btn btn-large btn-primary btn-block'))}}
{{ Form::close() }}
@stop