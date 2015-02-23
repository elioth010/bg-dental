@extends('layouts.main')

@section('javascripts')
    <script src="//davidlynch.org/projects/maphilight/jquery.maphilight.js"></script>
    <script src="/js/presupuestos.js"></script>
@stop

<div>
@section('contenido')
<div class="top_reg">
    <h1>Datos del paciente</h1>
	<ul class="labelreg6">
	    <li>NHC: <span class="bold">{{ $paciente->numerohistoria }}</span></li>
	    <li>Nombre: <span class="bold">{{ $paciente->nombre }} {{ $paciente->apellido1 . ' ' . $paciente->apellido2 }}</span></li>
	    <li>NIF: <span class="bold">{{ $paciente->NIF }}</span></li>
	    <li>{{ $paciente->compania }}</li>
	</ul>

</div>

<div id="dodontograma" style="display: none">
@include('presupuestos.odontograma')
@yield('odontograma')

<button type="button" class="closeOdontograma">Cerrar</button>

</div>

<div>
	{{ Form::open(array('action' => array('PresupuestosController@store', $paciente->numerohistoria), 'id' => 'NuevoPresuForm')) }}
    <h1>Nuevo presupuesto</h1>
	<ul class="labelreg6">
    	<li>{{ Form::hidden('numerohistoria', $paciente->numerohistoria) }}</li>
   		<li>{{ Form::hidden('num_tratamientos', 1) }}</li>
    	<li>{{ Form::label('nombre', 'Nombre del presupuesto:') }} {{ Form::text('nombre', $presupuesto->nombre) }}</li>
	<li>{{ Form::label('descuento', 'Descuento total:') }} {{ Form::text('descuento', $presupuesto->descuento, array('onchange' => 'updatePrecios()', 'size' => 3)) }}{{ Form::select('tipodescuento', array('E' => 'EUR', 'P' => '%'),
                    $presupuesto->tipodescuento, array('id' => 'tipodescuento', 'onchange' => 'updatePrecios()')) }}</li>

    	<li>{{ Form::label('profesional', 'Profesional:') }} {{ Form::select('tprofesional', $profesionales) }}</li>
    </ul>

   		<div>
        <h2>Tratamientos</h2>
        <div id='tratamientos'>
        </div>
        <!-- {{ HTML::link('#', 'Añadir', array('id' => 'b_addTratamiento', 'onclick' => 'addTratamiento()')) }} -->
        {{ Form::button('Añadir', array('id' => 'b_addTratamiento', 'onclick' => 'addTratamiento()')) }}
<div>
        <ul class="labelreg6">
        <li><h2>Precio</h2></li>
        <li>Subtotal: <span id="p_subtotal">0.00</span></li>
        <li>Descuento total: <span id="p_descuento">0</span></li>
        <li>Total: <span id="p_total">0.00</span></li>
		<li>{{ Form::submit('Guardar cambios')}} {{ Form::button('Atrás')}} {{ HTML::linkAction('PresupuestosController@verpresupuestos', 'Presupuestos de este paciente', array($paciente->numerohistoria)) }}   <?php if (!empty($tratamientos)) { ?></li>
    {{ Form::close() }}
    	<li>        {{ HTML::linkAction('PresupuestosController@borrarPresupuesto', 'Eliminar este presupuesto',
                            array($paciente->numerohistoria, $presupuesto->id)) }}
    <?php } ?>
</li>
    	</ul>
</div>
</div>
<script type="text/javascript">
    var grupos = {{ json_encode($grupos) }}
    var tratamientos = {{ json_encode($atratamientos) }}
    var odontograma = []
    var lastIndex = 0

    $(document).ready(function() {

    <?php if (empty($tratamientos)) { ?>
        addTratamiento()

        $('#p_subtotal').text('0.00')
        $('#p_descuento').text('0.00')
        $('#p_total').text('0.00')

    <?php } else { ?>
        @foreach($tratamientos as $key => $t)
            // TODO: No se guarda el grupo

            addTratamiento({{ $t["grupostratamientos_id"] }}, {{ $t["tratamiento_id"] }})

        @endforeach
        // updatePrecios()
    <?php } ?>

    });
</script>

@stop
