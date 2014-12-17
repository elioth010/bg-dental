@extends('layouts.main')

 
@section('contenido')
    
<div>
    <h1>Presupuestos del paciente</h1>
    
	
	    NHC:
	    {{$paciente->numerohistoria}}<br>
	    Nombre:
	    {{$paciente->nombre}}
	    
	    {{$paciente->apellido1.' '.$paciente->apellido2}}<br>
	    NIF:
	    {{$paciente->NIF}}
	    {{$paciente->compania}}
	    
	 
</div>

<div>
{{ Form::open(array('url'=>'pacientes/$paciente->numerohistoria/guardarpresupuesto')) }}     
    <h1>Nuevo presupuesto</h1>
    
    {{ Form::hidden('numerohistoria', null, array('placeholder'=>$paciente->numerohistoria)) }}
    <div>Nombre del presupuesto:
    {{ Form::text('nombre') }}<p>
    {{Form::select('grupo', $grupos, null, array('onchange' => '"getState(this.value)"'))}}
    </div>
    <div tratamientosdiv>
    	{{Form::select('tratamiento', ['Elija primero un grupo de tratamientos'])}}
    </div>
    
    <p></p>
    {{ Form::submit('Guardar cambios')}}
    {{ Form::button('Atrás')}} {{ HTML::link('pacientes/'.$paciente->numerohistoria.'/presupuestos', 'Presupuestos de este paciente') }}
    {{ Form::close() }}
</div>
@stop

