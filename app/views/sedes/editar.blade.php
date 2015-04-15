@extends('layouts.main')
 
@section('contenido')
{{ Form::open(array('url'=>'sede/'.$sede->id, 'method' => 'put')) }}
<div class="tbl_izq">
    <h1>Editar sede</h1>
    <ul class="labelreg4">
        <li>Nombre:</li>
        <li>Direción:</li>
        <li>C.P.</li>
        <li>Ciudad</li>
        <li>Provincia:</li>
        <li>Teléfono:</li>
        <li>Mail:</li>

</ul>

<ul class="labelreg3">
 	<li>{{ Form::text('nombre', $sede->nombre) }}</li>
        <li>{{ Form::text('calleynum', $sede->calleynum) }}</li>
        <li>{{ Form::text('cp', $sede->cp) }}</li>
        <li>{{ Form::text('ciudad', $sede->ciudad) }}</li>
        <li>{{ Form::text('provincia', $sede->provincia) }}</li>
        <li>{{ Form::text('tel', $sede->tel) }}</li>
        <li>{{ Form::text('mail', $sede->mail) }}</li>
        
    <br>
    <li>{{ Form::submit('Guardar cambios')}}</li>
    <li>{{--{{ Form::button('Atrás', array('class'=>'botonl'))}}--}}
</ul>
    
{{ Form::close() }}

<div class="tbl_drc">
@yield('listado_sedes')
</div>
@stop