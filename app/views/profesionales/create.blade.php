@extends('layouts.main')

@section('javascripts')
    <script src="/js/bgdental.js"></script>
@stop

@section('contenido')
{{ Form::open(array('url'=>'profesional')) }}
<div class="tbl_izq">
    <h1>Creación de profesionales</h1>
    <ul class="labelreg4">
    <li>Nombre</li>
    <li>Apellidos</li>
    <li>Especialidad</li>
    <li>Usuario</li>
    </ul>
    <ul class="labelreg3">
    <li>{{ Form::text('nombre', null, array('placeholder'=>'nombre')) }}</li>
	<li>{{ Form::text('apellido1', null, array('placeholder'=>'apellido1')) }}{{ Form::text('apellido2', null, array('placeholder'=>'apellido2')) }}</li>
	<li>{{ Form::select('especialidades_id', $especialidades, null) }}</li>
    <li>{{ Form::select('user_id', $usuarios) }}</li>

    @foreach($sedes as $sede)
    <div>{{ Form::checkbox('sede-'.$sede->id, 1) }} {{$sede->nombre}}</div>
    @endforeach

    <li>{{ Form::submit('Guardar profesional', array('class'=>'botonl'))}}</li>
		{{ Form::close() }}
	</ul>
</div>

<div class="tbl_drc">
@yield('listado_profs')
</div>


<script type="text/javascript">
    $(document).ready(function() {
        initSelectSedes();
    });
</script>

@stop
