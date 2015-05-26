<?php

class EstadisticasController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $grupousuario = Auth::user()->group_id;
		$facturacion = array();
        if($grupousuario != 1){
	        $usuario = Auth::user()->id;
	        $profesional_para_facturacion = Profesional::where('user_id', $usuario)->firstOrFail()->toArray();
	        $facturacion = Historial_clinico::where('profesional_id', $profesional_para_facturacion['id'])
	                ->leftJoin('pacientes', 'pacientes.id', '=', 'historial_clinico.paciente_id')
	                ->leftJoin('tratamientos', 'historial_clinico.tratamiento_id', '=', 'tratamientos.id')
	                ->select('historial_clinico.*', 'tratamientos.nombre as t_n', 'pacientes.nombre as p_n', 'pacientes.apellido1 as p_a1', 'pacientes.apellido2 as p_a2', 'tratamientos.*')
	                ->get();
	        $profesionales = Profesional::where('user_id', $usuario)->get();
	        var_dump($facturacion);
	        return View::make('estadisticas.index')->with('profesionales', $profesionales)->with('facturacion', $facturacion);
        } else {
            $profesionales = Profesional::get();
            return View::make('estadisticas.index')->with('profesionales', $profesionales)->with('facturacion', $facturacion);
        }
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
