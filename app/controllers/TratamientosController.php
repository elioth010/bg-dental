<?php

class TratamientosController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//$companias_cabecera = Companias::orderBy('nombre')->all();
		$tcp = Precios::leftJoin('tratamientos', 'tratamientos.id', '=', 'tratamientos_id')
					->leftJoin('companias', 'companias.id','=','companias_id')
					->select('tratamientos.nombre as nombre_trat', 'companias.nombre as nombre_comp', 'precio', 'tratamientos.id')
					->get();
		//$companias = Precios::leftJoin('tratamientos', 'tratamientos.id', '=', 'tratamientos_id')
		/*			->leftJoin('companias', 'companias.id','=','companias_id')
					->select('tratamientos.nombre as nombre_trat', 'companias.nombre as nombre_comp', 'precio')
					->groupBy('companias.nombre')
					->get();*/
		return View::make('tratamientos.index')->with(array('tcp' => $tcp));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('tratamientos.crear');
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
	public function show()
	{
		return View::make('tratamientos.buscar');
	}

	public function busqueda()
	 {
		$nombre = Input::get('nombre');
		if($nombre){
		$nombre = "%".$nombre."%";
		}
		$codigo = Input::get('codigo');
		if($codigo){
		$codigo = "%".$codigo."%";
		}
		if($nombre || $codigo) {
		  $tratamientos = Tratamientos::where('nombre','LIKE', $nombre)->orWhere('codigo','LIKE', $codigo)->get();
		  foreach($tratamientos as $tratamiento){
		  $tratamiento_id = $tratamiento->id;
		  }
		  $tcp = Precios::leftJoin('tratamientos', 'tratamientos.id', '=', 'tratamientos_id')
					->leftJoin('companias', 'companias.id','=','companias_id')
					->select('tratamientos.nombre as nombre_trat', 'companias.nombre as nombre_comp', 'precio', 'tratamientos.id')
					->where('tratamientos.id' , $tratamiento->id)
					->get();
		
		} else {
		  return Redirect::to('pacientes/buscar');
		}
		//var_dump($paciente);
		
		
		return View::make('tratamientos.vertratamiento')->with('tratamientos',$tratamientos)->with('tcp' , $tcp);
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
