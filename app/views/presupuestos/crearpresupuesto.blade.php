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
    {{ Form::label('descuento', 'Descuento total:') }}
    {{ Form::text('descuento', $presupuesto->descuento, array('onchange' => 'updatePrecios()')) }}
    {{ Form::select('tipodescuento', array('E' => 'EUR', 'P' => '%'),
                    $presupuesto->tipodescuento, array('id' => 'tipodescuento', 'onchange' => 'updatePrecios()')) }}

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

    <!--
    <div id="piezasdiv">
        <h2>Piezas</h2>
        {{ Form::label('pieza1', 'Desde la pieza:') }}
        {{ Form::text('pieza1') }}
        {{ Form::label('pieza2', 'Hasta la pieza:') }}
        {{ Form::text('pieza2') }}
    </div>
-->

    <div>
        <h2>Precio</h2>
        <p>Subtotal: <span id="p_subtotal"></span></p>
        <p>Descuento: <span id="p_descuento"></span></p>
        <p>Total: <span id="p_total"></span></p>
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
        tratamientosSelect.options[tratamientosSelect.options.length]=new Option('-- Elija un tratamiento --', '0')
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
    select2 = $('<select>').attr({onchange: "updatePrecios()", id: "s_" + trat, name: trat})

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

function updatePrecios() {
    console.log('updatePrecios')

    subtotal = 0
    for (i=1; i<=lastIndex; i++) {
        g = $('#grupo-' + i)[0].value
        t = $('#s_tratamiento-' + i)[0].selectedIndex
        if (t != 0) subtotal += parseInt(tratamientos[g][t]['precio'])
    }

    desc = $('#descuento')[0].value
    tdesc = $('#tipodescuento')[0].value
    if (tdesc == 'E') {
        descuento = desc
        descuentotext = desc
    } else {
        descuento = desc * subtotal / 100
        descuentotext = descuento + ' (' + desc + '%)'
    }
    total = subtotal - descuento
    $('#p_subtotal')[0].innerText = subtotal
    $('#p_descuento')[0].innerText = descuentotext
    $('#p_total')[0].innerText = total
}

$(document).ready(function() {

<?php if (empty($tratamientos)) { ?>
    addTratamiento()

    $('#p_subtotal')[0].innerText = '0.00'
    $('#p_descuento')[0].innerText = '0.00'
    $('#p_total')[0].innerText = '0.00'

<?php } else { ?>
    @foreach($tratamientos as $t)
    // TODO: No se guarda el grupo
    // addTratamiento({{$t->grupo}}, {{$t->trat}})
    addTratamiento(1, {{$t->pivot->tratamiento_id}})

    @endforeach
    updatePrecios()
<?php } ?>

});


</script>

@stop
