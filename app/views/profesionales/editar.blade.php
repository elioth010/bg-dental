@extends('layouts.main')
 
@section('contenido')
{{ Form::open(array('url'=>'profesional/'.$profesional->p_id, 'method' => 'put')) }}

    <h1>Editar datos de profesional:</h1>
     
    <ul class="labelreg4">
    <li>Nombre</li>
    <li>Apellidos</li>
    <li>Especialidad</li>
    <li>Usuario</li>
    </ul>
    <ul class="labelreg3">
    <li>{{ Form::text('nombre', $profesional->nombre) }}</li>
	<li>{{ Form::text('apellido1', $profesional->apellido1) }}{{ Form::text('apellido2', $profesional->apellido2) }}</li>
	<li>{{ Form::select('especialidades_id', $especialidades, $profesional->especialidades_id) }}</li>
        <li>@if($profesional->user_id > 0)
            {{ Form::select('user_id', $usuarios, $profesional->user_id) }}
            @else
            {{ Form::select('user_id', array('default' => 'Asigne un usuario')+$usuarios ) }}
            @endif
        </li>
        
        
        <?php $i = 1; ?>       
  @foreach($sedes as $sede)
  <input type="Checkbox" name="sede-{{$i}}" value="{{$sede->id}}"
         
         
         @foreach($sedes_pid as $k => $sede_pid)
             @if ($sede->id === $sede_pid)
             checked
             @endif
         @endforeach
         >{{$sede->nombre}}
  <?php $i++; ?>
  @endforeach
  
        
    <li>{{ Form::submit('Guardar profesional', array('class'=>'botonl'))}}</li>
		{{ Form::close() }}
	</ul>
    
{{ Form::close() }}
@yield('listado_sedes')

@stop
