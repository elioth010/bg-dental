@extends('layouts.main')

@section('contenido')
<div class="overflow">
<h2>Crear Turnos {{$sede->nombre}}</h2>
{{ Form::open(array('url'=>'turno')) }}
{{Form::hidden('sede_id', $sede->id)}}

<table>
    <tr>
        <th>TURNO</th>
        <th>Lunes</th>
        <th>Martes</th>
        <th>Miércoles</th>
        <th>Jueves</th>
        <th>Viernes</th>
    </tr>
    <tr>
        <td>Mañana 1</td>
        @for ($i = 0; $i < 5; $i++)
        <td>{{Form::select('profesional-m1-'.$i, $profesionales)}}</td>
        @endfor
    </tr>
    <tr>
        <td>Mañana 2</td>
        @for ($i = 0; $i < 5; $i++)
        <td>{{Form::select('profesional-m2-'.$i, $profesionales)}}</td>
        @endfor
    </tr>
    <tr>
        <td>Tarde 1</td>
        @for ($i = 0; $i < 5; $i++)
        <td>{{Form::select('profesional-t1-'$i, $profesionales)}}</td>
        @endfor
    </tr>
    <tr>
        <td>Tarde 2</td>
        @for ($i = 0; $i < 5; $i++)
        <td>{{Form::select('profesional-t2-'$i, $profesionales)}}</td>
        @endfor
    </tr>
</table>

<li>{{ Form::submit('Guardar turnos', array('class'=>'botonl'))}}</li>
{{Form::close()}}
</div>
@stop
