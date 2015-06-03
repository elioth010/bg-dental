@extends('layouts.main')

@section('javascripts')
    <script src="/js/turnos.js"></script>
@stop

@section('contenido')
<h2>Turnos en la sede {{ $sede->nombre }} ({{ $fecha }})</h2>

@if(Auth::user()->isAdmin())
// TODO: remove
{{HTML::linkAction('TurnoController@edit', 'Modificar turnos', $sede->id) }}
@endif
{{ $calendario }}

<script type="text/javascript">

    $(document).ready(function() {
        $(".modifcancelbutton").hide();
        $(".modifsavebutton").hide();
        $(".selectturnosdia").hide();
    });
</script>
@stop
