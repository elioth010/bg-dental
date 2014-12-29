@extends('layouts.main')
 
@section('contenido')
crear.blade.php
    @if ($errors->has())

        @foreach ($errors->all() as $error)
            {{ $error }}</br>
        @endforeach

    @endif
    <div id="crear">
{{ Form::open(array('url'=>'pacientes/guardar')) }}     
    <h1>Datos del nuevo paciente</h1>
    NHC:
    {{ Form::text('numerohistoria', 'automático') }}
    Nombre:
    {{ Form::text('nombre') }}
    Apellidos:
    {{ Form::text('apellido1') }}
    {{ Form::text('apellido2') }}   </p>
    NIF: {{ Form::text('NIF') }}
    Fecha de nacimiento: {{ Form::select('dia', range(1, 31) + array(''=>"Día"), Input::old('dia'))}}{{ Form::selectMonth('mes') }}{{ Form::select('ano', range(1900, 2014) + array(''=>"Año"), Input::old('ano'))}}</br>
    <p>Tipo vía: {{ Form::text('addrnamestre') }}</p>
    <p>Dirección: {{ Form::text('direccion') }}</p>
    <p>Provincia: {{ Form::text('terrdesc') }}</p>
    <p>Código postal: {{ Form::text('addrpostcode') }}</p>
    
    <p>Teléfono 1: {{ Form::text('addrtel1') }}</p>
    <p>Teléfono 2: {{ Form::text('addrtel2') }}</p>
    <p>Correo electrónico: {{ Form::text('mail') }}</p>


    <p>Mujer: {{ Form::radio('sex', 'mujer') }}</br>
	Hombre: {{ Form::radio('sex', 'varon') }} </p>


    <p>Compañía: {{ Form::select('compania', $companias, null) }}
    </p></br>
    {{ Form::submit('Guardar cambios')}}
    {{HTML::link('previous', 'volver')}}

{{ Form::close() }}
	</div>
@stop