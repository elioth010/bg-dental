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
        <?php
        $i = 1;
        ?>
        @while($i <= 5)
        <td>
            
            {{Form::select('profesional', $profesionales)}}
            
        </td>
        <?php
        $i++;
        ?>
        @endwhile
    </tr>
    <tr>
        <td>Mañana 2</td>
        <?php
        $i = 1;
        ?>
        @while($i <= 5)
        <td>
            
            {{Form::select('profesional', $profesionales)}}
            
        </td>
        <?php
        $i++;
        ?>
        @endwhile
    </tr>
    <tr>
        <td>Tarde 1</td>
        <?php
        $i = 1;
        ?>
        @while($i <= 5)
        <td>
            
            {{Form::select('profesional', $profesionales)}}
            
        </td>
        <?php
        $i++;
        ?>
        @endwhile
    </tr>
    <tr>
        <td>Tarde 2</td>
        <?php
        $i = 1;
        ?>
        @while($i <= 5)
        <td>
            
            {{Form::select('profesional', $profesionales)}}
            
        </td>
        <?php
        $i++;
        ?>
        @endwhile
    </tr>
</table>

<li>{{ Form::submit('Guardar turnos', array('class'=>'botonl'))}}</li>
{{Form::close()}}
</div>
@stop