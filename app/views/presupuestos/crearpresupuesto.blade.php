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
    {{ Form::label('nombre', 'Nombre del presupuesto:') }}
    {{ Form::text('nombre') }}
    {{ Form::label('descuento', 'Descuento:') }}
    {{ Form::text('descuento') }}

    <div>
        <h2>Tratamientos</h2>
        <div id='tratamientos-1'>
            {{ Form::label('grupo-1', 'Grupo de tratamientos:') }}
            {{ Form::select('grupo-1', $grupos, null, array('onchange' => 'updateTratamientos(1, this.selectedIndex)')) }}
            {{ Form::label('tratamiento-1', 'Tratamiento:') }}
            {{ Form::select('tratamiento-1', array($tratamientos[0]), null,
                                            array('id' => 's_tratamiento-1',
                                                'onchange' => 'updatePrecios(1, this.selectedIndex)'))}}
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

var tratamientos = {{ json_encode($tratamientos) }}
var lastIndex = 1

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

function addTratamiento() {
    lastIndex++
    console.log('addTratamiento... ' + lastIndex)

    div = $("div[id^=tratamientos]:last")
    div2 = div.clone()
    div2[0].id = 'tratamientos-' + lastIndex

    div2.children('label').attr('for',
        function(index, old) { return old.replace(/\d+/, lastIndex); }
    );
    div2.children('select').attr('name',
        function(index, old) { return old.replace(/\d+/, lastIndex); }
    );
    div2.children('select').attr('id',
        function(index, old) { return old.replace(/\d+/, lastIndex); }
    );
    div2.insertAfter(div)

    $('#grupo-' + lastIndex)[0].setAttribute("onchange", 'updateTratamientos(' + lastIndex + ', this.selectedIndex)');
    $('#tratamiento-' + lastIndex)[0].setAttribute("onchange", 'updatePrecio(' + lastIndex + ', this.selectedIndex)');

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

});


</script>

@stop
