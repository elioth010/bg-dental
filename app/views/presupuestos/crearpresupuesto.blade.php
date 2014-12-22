@extends('layouts.main')

@section('contenido')

<div>
    <h1>Presupuestos del paciente</h1>


	    NHC:
	    {{ $paciente->numerohistoria }}<br>
	    Nombre:
	    {{ $paciente->nombre }}

	    {{ $paciente->apellido1 . ' ' . $paciente->apellido2 }}<br>
	    NIF:
	    {{ $paciente->NIF }}
	    {{ $paciente->compania }}


</div>

<div>
{{ Form::open(array('url' => "pacientes/$paciente->numerohistoria/guardarpresupuesto", 'id' => 'NuevoPresuForm')) }}
    <h1>Nuevo presupuesto</h1>

    {{ Form::hidden('numerohistoria', $paciente->numerohistoria) }}

    <div>Nombre del presupuesto:
        {{ Form::text('nombre') }}<p>
        {{ Form::select('grupo', $grupos, null, array('onchange' => 'updateTratamientos(this.selectedIndex)')) }}
    </div>
    <div id="tratamientosdiv">
        {{Form::select('tratamiento', array($tratamientos[0]), null, array('id' => 's_tratamiento'))}}
    </div>

    {{ Form::submit('Guardar cambios')}}
    {{ Form::button('Atrás')}} {{ HTML::linkAction('PresupuestosController@verpresupuestos', 'Presupuestos de este paciente', array($paciente->numerohistoria)) }}
    {{ Form::close() }}
</div>


<script type="text/javascript">

var tratamientos = {{ json_encode($tratamientos) }}
var tratamientosSelect = $('#s_tratamiento')[0]

function updateTratamientos(index) {
    tratamientosSelect.options.length=0;
    console.log(index);

    if (index == 0) {
        tratamientosSelect.options[tratamientosSelect.options.length]=new Option(tratamientos[0], 0)
    } else {
        for (i=0; i<tratamientos[index].length; i++) {
            t = tratamientos[index][i]
            tratamientosSelect.options[tratamientosSelect.options.length]=new Option(t['nombre'], t['id'])
        }
    }
}

$(document).ready(function() {
    updateTratamientos(0);
});


</script>

@stop
