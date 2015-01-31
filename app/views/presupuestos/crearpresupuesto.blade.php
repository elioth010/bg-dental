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
{{ Form::open(array('action' => array('PresupuestosController@store', $paciente->numerohistoria), 'id' => 'NuevoPresuForm')) }}
    <h1>Nuevo presupuesto</h1>

    {{ Form::hidden('numerohistoria', $paciente->numerohistoria) }}
    {{ Form::hidden('num_tratamientos', 1) }}
    {{ Form::label('nombre', 'Nombre del presupuesto:') }}
    {{ Form::text('nombre', $presupuesto->nombre) }}
    {{ Form::label('descuento', 'Descuento:') }}
    {{ Form::text('descuento') }}
    {{ Form::select('tdescuento', array('E' => 'EUR', 'P' => '%'), 'E') }}
    <br>
    {{ Form::label('profesional', 'Profesional:') }}
    {{ Form::select('tprofesional', $profesionales) }}
    <div>
        <h2>Tratamientos</h2>
        <div id='tratamientos'>
        </div>
        <br/>
        {{ HTML::link('#', 'Añadir', array('id' => 'b_addTratamiento', 'onclick' => 'addTratamiento()')) }}
    </div>

    <div id="piezasdiv">
        <h2>Piezas</h2>
        {{ Form::label('pieza1', 'Desde la pieza:') }}
        {{ Form::text('pieza1') }}
        {{ Form::label('pieza2', 'Hasta la pieza:') }}
        {{ Form::text('pieza2') }}
    </div>
    <div>
        <h2>Precio</h2>
        <p>Subtotal: <span id="p_subtotal">0.00</span></p>
        <p>Descuento: <span id="p_descuento">0.00</span></p>
        <p>Total: <span id="p_total">0.00</span></p>
    </div>
    {{ Form::submit('Guardar cambios')}}
    {{ Form::button('Atrás')}} {{ HTML::linkAction('PresupuestosController@verpresupuestos', 'Presupuestos de este paciente', array($paciente->numerohistoria)) }}
    {{ Form::close() }}
</div>


<script type="text/javascript">

var grupos = {{ json_encode($grupos) }}
var tratamientos = {{ json_encode($atratamientos) }}
var lastIndex = 0

function updateTratamientos(id, index) {
    console.log('updateTratamientos ' + id + ' ' + index)
    tratamientosSelect = $('#s_tratamiento-' + id)[0]
    tratamientosSelect.options.length=0

    if (index == 0) {
        tratamientosSelect.options[tratamientosSelect.options.length]=new Option(tratamientos[0], 0)
    } else {
        for (i=0; i<tratamientos[index].length; i++) {
            t = tratamientos[index][i]
            tratamientosSelect.options[tratamientosSelect.options.length]=new Option(t['nombre'], t['id'])
        }
    }
}

function addTratamiento(gid, tid) {
    lastIndex++
    console.log('addTratamiento... ' + lastIndex)

    grupo = "grupo-" + lastIndex
    trat = "tratamiento-" + lastIndex

    label1 = $("<label>").attr({for: grupo}).text('Grupo de tratamientos:')
    select1 = $('<select>').attr({onchange: "updateTratamientos(" + lastIndex + ", this.selectedIndex)", id: grupo, name: grupo})
    label2 = $("<label>").attr({for: trat}).text('Tratamiento:')
    select2 = $('<select>').attr({onchange: "updatePrecios(" + lastIndex + ", this.selectedIndex)", id: "s_" + trat, name: trat})

    for(var i = 0; i < grupos.length; i++) {
        select1.append(new Option(grupos[i], i))
    }

    if (tid == null) {
        select2.append(new Option(tratamientos[0], 0))
    } else {
        for(var i = 0; i < tratamientos.length; i++) {
            console.log('updateTratamientos ' + tratamientos[1][i]['nombre'] + ' ' + tratamientos[1][i]['id'])
            select2.append(new Option(tratamientos[1][i]['nombre'], tratamientos[1][i]['id']))
        }
    }

    nuevodiv = $("<div>").attr({id: trat})
    nuevodiv.append(label1)
    nuevodiv.append(select1)
    nuevodiv.append(label2)
    nuevodiv.append(select2)

    div = $("#tratamientos")
    div.append(nuevodiv)

    $('input[name="num_tratamientos"]').val(lastIndex)

    if (gid) select1.val(gid)
    if (tid) select2.val(tid)

    return false
}

function updatePrecios(id, index) {
    console.log('updatePrecios ' + id + ' ' + index)

    $('#grupo-' + id)[0]
    precio = tratamientos[id][index]['precio']
    $('#p_subtotal').text(precio)
    $('#p_total').text(precio)
}

$(document).ready(function() {

<?php if (empty($tratamientos)) { ?>
    addTratamiento()

<?php } else { ?>
    @foreach($tratamientos as $t)
    // TODO: No se guarda el grupo
    // addTratamiento({{$t->grupo}}, {{$t->trat}})
    addTratamiento(1, {{$t->pivot->tratamiento_id}})

    @endforeach
<?php } ?>

});


</script>

@stop
