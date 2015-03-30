<?php

class ProfesionalController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
//		$profesionales = Profesional::leftJoin('especialidades', 'especialidades.id', '=', 'profesionales.especialidades_id')->get();
//                $especialidades = Especialidad::lists('especialidad','id');
//                return View::make('profesionales.index', array('profesionales' => $profesionales))->with('especialidades', $especialidades);
                return Redirect::to('profesional/create');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$profesionales = Profesional::leftJoin('especialidades', 'especialidades.id', '=', 'profesionales.especialidades_id')
                        ->leftJoin('sedes', 'sedes.id','=','profesionales.sede_id')->get();
                $sedes = Sedes::lists('nombre','id');
                $especialidades = Especialidad::lists('especialidad','id');
                return View::make('profesionales.index', array('profesionales' => $profesionales, 'especialidades'=> $especialidades, 'sedes' => $sedes));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		Profesional::create(Input::all());
		echo "Profesional guardado";
		return Redirect::to('profesional');
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
