@extends('layouts.main')
 
@section('contenido')
crear.blade.php    
{{ Form::open(array('url'=>'pacientes/guardar')) }}     
    <h1>Datos del nuevo paciente</h1>
    NHC:
    {{ Form::text('numerohistoria', 'automático') }}
    Nombre:
    {{ Form::text('nombre') }}
    Apellidos:
    {{ Form::text('apellido1') }}
    {{ Form::text('apellido2') }}
    </p>NIF:
    {{ Form::text('NIF') }}
    Fecha de nacimiento: {{ Form::select('dia', range(1, 31) + array(''=>"Día"), Input::old('dia'))}}{{ Form::selectMonth('mes') }}{{ Form::select('ano', range(1900, 2014) + array(''=>"Año"), Input::old('ano'))}}</p>
    Tipo vía: {{ Form::text('addrnamestre') }}</p>
    Dirección: {{ Form::text('direccion') }}</p>
    Provincia: {{ Form::text('terrdesc') }}</p>
    Código postal: {{ Form::text('addrpostcode') }}</p>
    
    Teléfono 1: {{ Form::text('addrtel1') }}</p>
    Teléfono 2: {{ Form::text('addrtel2') }}</p>
    Sexo: {{ Form::text('sexo') }}</p>
    Compañía: {{ Form::select('compania', $companias, null) }}
    </p>
    {{ Form::submit('Guardar cambios')}}
    {{HTML::link('previous', 'volver')}}
    


{{ Form::close() }}
@stop