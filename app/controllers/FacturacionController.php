<?php

class FacturacionController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            $fecha_actual = date('Y-m-d');
            $fecha_primeros = date('Y-m-');
            $primeros_de_mes = $fecha_primeros."1";
            var_dump($fecha_actual);
            var_dump($primeros_de_mes);
            $historial = Historial_clinico::whereBetween('fecha_realizacion', array($fecha_primeros, $fecha_actual))->orderBy('fecha_realizacion')->get();
            var_dump($historial);
            //return View::make('facturacion.index');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
