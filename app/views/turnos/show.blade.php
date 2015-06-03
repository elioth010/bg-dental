@extends('layouts.main')

@section('javascripts')
    <script src="/js/turnos.js"></script>
@stop

@section('contenido')
<h2>Turnos en la sede {{ $sede->nombre }} ({{ $fecha }})</h2>

{{ $calendario }}

<script type="text/javascript">

    $(document).ready(function() {
        $(".modifcancelbutton").hide();
        $(".modifsavebutton").hide();
        $(".selectturnosdia").hide();
    });
</script>
@stop
