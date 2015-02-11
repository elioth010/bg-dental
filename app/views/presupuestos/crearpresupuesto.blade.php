@extends('layouts.main')

@section('javascripts')
    <script src="//davidlynch.org/projects/maphilight/jquery.maphilight.js"></script>
    <script src="/js/presupuestos.js"></script>
@stop

@section('contenido')
<div>
    <h1>Datos del paciente</h1>
	    NHC:
	    {{ $paciente->numerohistoria }}<br>
	    Nombre:
	    {{ $paciente->nombre }} {{ $paciente->apellido1 . ' ' . $paciente->apellido2 }}
	    <br>
	    NIF:
	    {{ $paciente->NIF }}
        <br>
        Compañía:
	    {{ $paciente->compania }}
</div>


<div id="dodontograma" style="display: none">
@include('presupuestos.odontograma')
@yield('odontograma')
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
        {{ Form::button('Añadir', array('id' => 'b_addTratamiento', 'onclick' => 'addTratamiento()')) }}
    </div>

    <div>
        <h2>Precio</h2>
        <p>Subtotal: <span id="p_subtotal"></span></p>
        <p>Descuento total: <span id="p_descuento"></span></p>
        <p>Total: <span id="p_total"></span></p>
    </div>
    {{ Form::submit('Guardar cambios')}}
    {{ Form::button('Atrás')}}
    {{ Form::close() }}

    <br/>
    {{ HTML::linkAction('PresupuestosController@verpresupuestos', 'Presupuestos de este paciente', array($paciente->numerohistoria)) }}
    <?php if (!empty($tratamientos)) { ?>
        <br/>
        {{ HTML::linkAction('PresupuestosController@borrarPresupuesto', 'Eliminar este presupuesto',
                            array($paciente->numerohistoria, $presupuesto->id)) }}
    <?php } ?>
</div>

<script type="text/javascript">
    var grupos = {{ json_encode($grupos) }}
    var tratamientos = {{ json_encode($atratamientos) }}
    var lastIndex = 0

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
