@extends('layouts.main')

@section('javascripts')
    <script src="/js/turnos.js"></script>
@stop

@section('contenido')
<div class="roll">
<h2>Turnos en la sede {{ $sede->nombre }} ({{ $fecha }})</h2>

{{ $calendario }}

<script type="text/javascript">

    var incidencias = {{ json_encode($incidencias) }}
    $(document).ready(function() {
        $(".modifcancelbutton").hide();
        $(".modifsavebutton").hide();
        $(".incidcancelbutton").hide();
        $(".incidsavebutton").hide();
        $(".incidenciasdia").hide();
        $(".selectturnosdia").hide();
    });
</script>
</div>
@stop
