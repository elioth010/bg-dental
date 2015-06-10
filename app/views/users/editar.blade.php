@extends('layouts.main')

@section('contenido')
{{ Form::open(array('url'=>'users/update/'.$user->u_id, 'method' => 'put')) }}

<h1>Editar Usuario</h1>
    <ul class="labelreg5">
        <li>Nombre:</li>
        <li>Apellidos:</li>
        <li>Mail:</li>
        <li>Permisos</li>
        <li>Sedes</li>
    </ul>

    <ul class="labelreg5">
        <li>{{ Form::text('firstname', $user->firstname) }}</li>
        <li>{{ Form::text('lastname', $user->lastname) }}</li>
        <li>{{ Form::text('email', $user->email) }}</li>
        <li>{{ Form::select('group_id', $usergroups, $user->group_id) }}</li>
        @foreach($sedes as $sede)
        <div>{{ Form::checkbox('sede-'.$sede->id, 1, in_array($sede->id, $sedes_pid)) }} {{$sede->nombre}}</div>
        @endforeach
        <li>{{ Form::submit('Guardar cambios')}}</li>
        <li>{{--{{ Form::button('Atrás', array('class'=>'botonl'))}}--}}
    </ul>

{{ Form::close() }}

<script type="text/javascript">
    $(document).ready(function() {
        $("input[name='sede-4']").change(function() {
            if($(this).is(":checked")) {
                marcarSedes(true);
            } else {
                marcarSedes(false);
            }
        });

        var todas_checked = $("input[name='sede-4']").is(':checked');
        if (todas_checked) {
            marcarSedes(true);
        }
    });

    function marcarSedes(value) {
        var inputs = $("input[name^='sede-']");
        inputs.each(function(index, input){
            if (input.name != 'sede-4') {
                input.disabled = value;
            }
        });
    }
</script>

@stop
