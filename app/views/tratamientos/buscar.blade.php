@extends('layouts.main')
 
@section('contenido')
Aquí tenemos el problema de que si el resultado de la búsqueda es sólo un tratamiento, no funciona el foreach($tcp as $$tcp) del blade. Si en cambio
los resultados son varios (si se busca endo, saldrán endodoncias y endodoncias complejas) sí funciona el foreach($tcp as $tcp). No sé si tendré que 
hacer dos views diferentes dependiendo de la cantidad de resultados que vomita la búsqueda...
{{ Form::open(array('url'=>'tratamientos/busqueda')) }}     
    <h1>Búsqueda de tratamientos</h1>
    {{ Form::text('nombre', null, array('placeholder'=>'Nombre')) }}
    {{ Form::text('codigo', null, array('placeholder'=>'Código Quirón')) }}
    {{ Form::submit('Buscar')}}
{{ Form::close() }}
@stop
 