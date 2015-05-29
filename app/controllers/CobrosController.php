<?php

class CobrosController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            $cobros = Cobros::leftJoin('tipos_de_cobro', 'tipos_de_cobro.id', '=', 'cobros.tipos_de_cobro_id')
                        ->leftJoin('pacientes', 'pacientes.id', '=', 'cobros.paciente_id')
                        ->select('cobros.*', 'tipos_de_cobro.nombre as tc_n', 'pacientes.nombre as p_n')
                        ->get();
            return View::make('cobros.index')->with('cobros', $cobros);
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
		  $cobros = Cobros::where('cobros.paciente_id', $id)
                         ->leftJoin('tipos_de_cobro', 'tipos_de_cobro.id', '=', 'cobros.tipos_de_cobro_id')
                        ->leftJoin('pacientes', 'pacientes.id', '=', 'cobros.paciente_id')
                        ->select('cobros.*', 'tipos_de_cobro.nombre as tc_n', 'pacientes.nombre as p_n')
                        ->get();
            return View::make('cobros.index')->with('cobros', $cobros);
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
