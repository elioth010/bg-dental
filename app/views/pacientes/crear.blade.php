@extends('layouts.main')
 
@section('contenido')
crear.blade.php
    @if ($errors->has())

        @foreach ($errors->all() as $error)
            {{ $error }}</br>
        @endforeach

    @endif

{{ Form::open(array('url'=>'pacientes/guardar')) }}     
    <h1>Datos del nuevo paciente</h1>
    

<ul class="labelreg5">
 	<li>NHC</li>
    <li>Nombre:</li>
    <li>Apellidos:</li>
    <li>NIF:</li>
    <li>Fecha de nacimiento</li>
    <li>Tipo de vía</li>
    <li>Dirección:</li>
    <li>Ciudad:</li>
    <li>Código Postal:</li>
    <li>Teléfonos:</li>
    <li>Correo electrónico</li>
    <li>Género</li>
    <li>Compañía:</li>
 
</ul>

<ul class="labelreg3">
 	<li>{{ Form::text('numerohistoria') }}</li>
    <li>{{ Form::text('nombre') }}</li>
    <li>{{ Form::text('apellido1') }} {{ Form::text('apellido2') }}</li>
    <li>{{ Form::text('NIF') }}</li>
    <li>{{ Form::select('dia', range(1, 31) + array(''=>"Día"), Input::old('dia'))}}{{ Form::selectMonth('mes') }}{{ Form::select('ano', range(1900, 2014) + array(''=>"Año"), Input::old('ano'))}}</li>
    <li>{{ Form::text('addrnamestre') }}</li>
    <li>{{ Form::text('direccion') }}</li>
    <li>{{ Form::text('terrdesc') }}</li>
    <li>{{ Form::text('addrpostcode') }}</li>
    <li>{{ Form::text('addrtel1') }}  {{ Form::text('addrtel2') }}</li>
    <li>{{ Form::text('mail') }}</li>
    <li>Mujer: {{ Form::radio('sex', 'mujer') }} Hombre: {{ Form::radio('sex', 'varon') }}</li>
    <li>{{ Form::select('compania', $companias, null) }} </li>
        <br>    
    <li>{{ Form::submit('Guardar cambios', array('class'=>'botonl'))}}</li>
    <li>{{HTML::link('previous', 'volver')}}</li>

</ul>

{{ Form::close() }}

@stop