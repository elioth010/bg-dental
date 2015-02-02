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
        <p>Descuento total: <span id="p_descuento"></span></p>
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
    lprecio = "precio-" + lastIndex
    lpreciof = "preciof-" + lastIndex
    ldescu = "descuento-" + lastIndex
    tdescu = "tipodescuento-" + lastIndex

    // Grupo de tratamientos
    label1 = $("<label>").attr({for: grupo}).text('Grupo de tratamientos:')
    select1 = $('<select>').attr({onchange: "updateTratamientos(" + lastIndex + ", this.selectedIndex)", id: grupo, name: grupo})

    // Tratamiento
    label2 = $("<label>").attr({for: trat}).text('Tratamiento:')
    select2 = $('<select>').attr({onchange: "updatePrecios(" + lastIndex + ", this.selectedIndex)", id: "s_" + trat, name: trat})

    // Descuento
    label3 = $("<label>").attr({for: ldescu}).text('Descuento:')
    input3 = $('<input>').attr({onchange: "updatePrecios(" + lastIndex + ")", id: ldescu, name: ldescu,
                                type: "text"})
    select3 = $('<select>').attr({onchange: "updatePrecios(" + lastIndex + ", this.selectedIndex)", id: "s_" + tdescu, name: tdescu})
    select3.append(new Option('EUR', 'E'))
    select3.append(new Option('%', 'P'))
    // TODO: default value: 0

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
    nuevodiv.append('Precio base: <span id="' + lprecio + '">0.00</span><br>')
    nuevodiv.append(label3)
    nuevodiv.append(input3)
    nuevodiv.append(select3)
    nuevodiv.append('Precio final del tratamiento: <span id="' + lpreciof + '">0.00</span>')

    div = $("#tratamientos")
    div.append(nuevodiv)

    $('input[name="num_tratamientos"]').val(lastIndex)

    if (gid) select1.val(gid)
    if (tid) select2.val(tid)

    return false
}

function updatePrecios(id, index) {
    console.log('updatePrecios ' + id + ', ' + index)

    if (id != null) {
        p1 = $('#precio-' + id)[0]
        p2 = $('#preciof-' + id)[0]
        desc = $('#descuento-' + id)[0].value
        tipodesc = $('#s_tipodescuento-' + id)[0].value

        if (index != null) {
            if (index == 0) {
                p1.innerText = '0.00'
                p2.innerText = '0.00'
            } else {
                g = $('#grupo-' + id)[0].value

                if (tipodesc == 'P') {
                    descuento = desc * tratamientos[g][index-1]['precio'] / 100
                    preciofinal = tratamientos[g][index-1]['precio'] - descuento
                } else {
                    preciofinal = tratamientos[g][index-1]['precio'] - desc
                }

                p1.innerText = tratamientos[g][index-1]['precio']
                p2.innerText = preciofinal
            }
        } else {
            if (tipodesc == 'P') {
                descuento = desc * p1.innerText / 100
                preciofinal = p1.innerText - descuento
            } else {
                preciofinal = p1.innerText - desc
            }

            p2.innerText = preciofinal
        }
    }


    subtotal = 0
    for (i=1; i<=lastIndex; i++) {
        //g = $('#grupo-' + i)[0].value
        //t = $('#s_tratamiento-' + i)[0].selectedIndex
        //if (t != 0) subtotal += parseInt(tratamientos[g][t-1]['precio'])
        subtotal += parseFloat($('#preciof-' + i)[0].innerText)
    }

    desc = $('#descuento')[0].value
    tdesc = $('#tipodescuento')[0].value
    if (tdesc == 'P') {
        descuento = desc * subtotal / 100
        descuentotext = descuento + ' (' + desc + '%)'
    } else {
        descuento = desc
        descuentotext = desc
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
