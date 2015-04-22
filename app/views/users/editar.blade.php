@extends('layouts.main')
 
@section('contenido')
{{ Form::open(array('url'=>'users/update/'.$user->u_id, 'method' => 'put')) }}

    <h1>Editar Usuario</h1>
    <ul class="labelreg3">
        <li>Nombre:</li>
        <li>Apellidos:</li>
        <li>Mail:</li>
        <li>Permisos</li>
        <li>Sedes</li>
    </ul>

<ul class="labelreg3">
 	<li>{{ Form::text('firstname', $user->firstname) }}</li>
        <li>{{ Form::text('lastname', $user->lastname) }}</li>
        <li>{{ Form::text('email', $user->email) }}</li>
        <li>{{Form::select('group_id', $usergroups, $user->group_id)}}
          <?php $i = 1; ?>       
            @foreach($sedes as $sede)
  <input type="Checkbox" name="sede-{{$i}}" value="{{$sede->id}}" 
         @foreach($sedes_pid as $k => $sede_pid)
             @if ($sede->id === $sede_pid)
             checked
             @endif
         @endforeach
         >{{$sede->nombre}}</br>
  <?php $i++; ?>
  @endforeach
        
    <br>
    <li>{{ Form::submit('Guardar cambios')}}</li>
    <li>{{--{{ Form::button('Atrás', array('class'=>'botonl'))}}--}}
</ul>
    
{{ Form::close() }}


@stop
