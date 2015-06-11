@extends('layouts.main')

@section('title')
    Editar sede
@stop

@section('contenido')
{{ Form::open(array('url'=>'sede/'.$sede->id, 'method' => 'put')) }}
    <h1>Editar sede</h1>
    <ul class="labelreg7">
        <li>Nombre:</li>
        <li>Direción:</li>
        <li>C.P.</li>
        <li>Ciudad</li>
        <li>Provincia:</li>
        <li>Teléfono:</li>
        <li>Mail:</li>
        <li>Cuenta bancaria:</li>

</ul>

<ul class="labelreg3">
 	<li>{{ Form::text('nombre', $sede->nombre) }}</li>
        <li>{{ Form::text('calleynum', $sede->calleynum) }}</li>
        <li>{{ Form::text('cp', $sede->cp) }}</li>
        <li>{{ Form::text('ciudad', $sede->ciudad) }}</li>
        <li>{{ Form::text('provincia', $sede->provincia) }}</li>
        <li>{{ Form::text('tel', $sede->tel) }}</li>
        <li>{{ Form::text('mail', $sede->mail) }}</li>
        <li>{{ Form::text('cuenta', $sede->cuenta) }}</li>

    <br>
    <li>{{ Form::submit('Guardar cambios')}}</li>
    <li>{{--{{ Form::button('Atrás', array('class'=>'botonl'))}}--}}</li>
</ul>

{{ Form::close() }}
@yield('listado_sedes')

@stop
