@extends('layouts.main')

@section('javascripts')
    <script src="/js/bgdental.js"></script>
@stop

@section('title')
    Profesionales
@stop

@section('contenido')
{{ Form::open(array('url'=>'profesional/'.$profesional->p_id, 'method' => 'put')) }}

    <h1>Editar datos de profesional:</h1>

    <ul class="labelreg4">
        <li>Nombre:</li>
        <li>Apellidos:</li>
        <li>Especialidad:</li>
        <li>Usuario:</li>
        <li>Sede:</li>
    </ul>
    <ul class="labelreg3">
    <li>{{ Form::text('nombre', $profesional->nombre) }}</li>
	<li>{{ Form::text('apellido1', $profesional->apellido1) }}{{ Form::text('apellido2', $profesional->apellido2) }}</li>
	<li>{{ Form::select('especialidades_id', $especialidades, $profesional->especialidades_id) }}</li>
    <li>@if($profesional->user_id > 0)
        {{ Form::select('user_id', array($profesional->user_id => $profesional->u_n.', '.$profesional->u_a.'  '.$profesional->u_a2.' (asignado actualmente)')+$usuarios, $profesional->user_id) }}
        @else
        {{ Form::select('user_id', $usuarios, 0 ) }}
        @endif
    </li>
    @foreach($sedes as $sede)
    <div>{{ Form::checkbox('sede-'.$sede->id, 1, in_array($sede->id, $sedes_pid)) }} {{$sede->nombre}}</div>
    @endforeach

    <br>{{ HTML::link('profesional/borrarprofesional/'.$profesional->p_id, 'Eliminar este profesional') }}<br>
    <li>{{ Form::submit('Guardar profesional', array('class'=>'botonl'))}}</li>
		{{ Form::close() }}
	</ul>

{{ Form::close() }}
@yield('listado_sedes')

<script type="text/javascript">
    $(document).ready(function() {
        initSelectSedes();
    });
</script>

@stop
