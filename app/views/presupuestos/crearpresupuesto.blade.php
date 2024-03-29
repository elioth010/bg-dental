@extends('layouts.main')

@section('title')
    Crear presupuesto
@stop

@section('javascripts')
    <script src="/js/jquery.maphilight.min.js"></script>
    <script src="/js/presupuestos.js"></script>
    <script src="/js/bgdental.js"></script>
@stop


@section('contenido')
<div class="overflow">
<div class="top_reg">
    <h1>Datos del paciente</h1>
	<ul class="labelreg6">
	    <li>NHC: <span class="bold">{{ $paciente->numerohistoria }}</span></li>
	    <li>Nombre: <span class="bold">{{ $paciente->nombre }} {{ $paciente->apellido1 . ' ' . $paciente->apellido2 }}</span></li>
	    <li>NIF: <span class="bold">{{ $paciente->NIF }}</span></li>
	    <li>Compañías: <span class="bold">{{ $paciente->companias_text }}<span class="bold"></li>
	</ul>

</div>

<div id="dodontograma" style="display: none">
@include('presupuestos.odontograma')
@yield('odontograma')

<button type="button" class="botonl" style="margin:5px;">Cerrar</button>

</div>


	{{ Form::open(array('action' => array('PresupuestosController@store', $paciente->numerohistoria), 'id' => 'NuevoPresuForm', 'onsubmit' => 'return validate_presupuesto(this);')) }}
    <h1>Nuevo presupuesto</h1>
	<ul class="labelreg6">
    	<li>{{ Form::hidden('numerohistoria', $paciente->numerohistoria) }}</li>
   		<li>{{ Form::hidden('num_tratamientos', 1) }}</li>
        <li>{{ Form::hidden('presupuesto_id', $presupuesto->id) }}</li>
    	<li>{{ Form::label('nombre', 'Nombre del presupuesto:') }} {{ Form::text('nombre', $presupuesto->nombre) }}</li>
	    <li>{{ Form::label('descuento', 'Descuento total:') }} {{ Form::text('descuento', $presupuesto->descuento, array('onchange' => 'updatePrecios()', 'size' => 3)) }}{{ Form::select('tipodescuento', array('E' => 'EUR', 'P' => '%'),
                    $presupuesto->tipodescuento, array('id' => 'tipodescuento', 'onchange' => 'updatePrecios()')) }}</li>

    	<li>{{ Form::label('profesional', 'Profesional:') }} {{ Form::select('tprofesional', $profesionales) }}</li>
        <li>{{ Form::label('compania_preferida', 'Compañía de seguro a usar por defecto:') }}
                {{ Form::select('companiadefecto', $companias_select, null, array('id' => 'companiadefecto', 'onchange' => 'updatePreciosCompanias(0, this.value)')) }}</li>
        <li>{{ Form::label('sede', 'Sede:') }} {{ Form::select('sede', $sedes, $presupuesto->sede_id, array('id' => 'sede')) }}</li>
    </ul>


        <h2>Tratamientos</h2>
        <div id='tratamientos'>
        </div>
        {{ Form::button('Añadir', array('id' => 'b_addTratamiento', 'onclick' => 'addTratamiento()')) }}
        <div>
            <ul class="labelreg6">
                <li><h2>Precio</h2></li>
                <li>Subtotal: <span id="p_subtotal">0,00 €</span></li>
                <li>Descuento total: <span id="p_descuento">0</span></li>
                <li>Total: <span id="p_total">0,00 €</span></li>
        		<li>{{ Form::submit('Guardar cambios')}} {{ Form::button('Atrás')}} {{ HTML::linkAction('PresupuestosController@verpresupuestos', 'Presupuestos de este paciente', array($paciente->numerohistoria)) }}   <?php if (!empty($tratamientos)) { ?></li>
    {{ Form::close() }}
            	<li>        {{ HTML::linkAction('PresupuestosController@borrarPresupuesto', 'Eliminar este presupuesto',
                                    array($paciente->numerohistoria, $presupuesto->id), array('onclick' => 'return confirm_eliminar();')) }}
            <?php } ?>
                </li>
        	</ul>
        </div>
        </div>

<script type="text/javascript">
    var grupos = {{ json_encode($grupos) }}
    var tratamientos = {{ json_encode($atratamientos) }}
    var companias = {{ json_encode($companias) }}
    var odontograma = []
    var lastIndex = 0

    $(document).ready(function() {

    <?php if (empty($tratamientos)) { ?>
        addTratamiento()

        $('#p_subtotal').text('0,00 €')
        $('#p_descuento').text('0,00 €')
        $('#p_total').text('0,00 €')

    <?php } else { ?>
        @foreach($tratamientos as $key => $t)
            addTratamiento({{ $t }})
            updatePrecios(lastIndex, {{ $t }})
        @endforeach
    <?php } ?>

    });
</script>

@stop
