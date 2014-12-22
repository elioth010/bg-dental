<?php

class PacientesController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		//$pacientes = Pacientes::on('quiron')->where('created_at', '>=', 'DATE_SUB(NOW(), INTERVAL 1 DAY)')->orderBy('created_at')->get();
		$pacientes = Pacientes::whereRaw('created_at >= DATE_SUB(NOW(), INTERVAL 1 DAY)')->orderBy('created_at')->get();
		//$pacientes = Pacientes::all();
		return View::make('pacientes.index', array('pacientes' => $pacientes));
		
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function crear()
	{
		$companias = Companias::lists('nombre', 'id');
		return View::make('pacientes.crear')->with(array('companias' => $companias));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$crear_p = Pacientes::create(Input::all());		
		return Redirect::to('pacientes');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	 public function busqueda()
	 {
		$busca = Input::get('nombre');
		if($busca) {
		  //$paciente = Pacientes::on('quiron')->whereRaw('nombre LIKE "%'.$busca.'%" or apellido1 LIKE "%'.$busca.'%"  or apellido2 LIKE "%'.$busca.'%"  or numerohistoria LIKE "%'.$busca.'%" ')->get();
		  $paciente = Pacientes::whereRaw('nombre LIKE "%'.$busca.'%" or apellido1 LIKE "%'.$busca.'%"  or apellido2 LIKE "%'.$busca.'%"  or numerohistoria LIKE "%'.$busca.'%" ')->get();
		  

		  
		} else {
		  return Redirect::to('pacientes/buscar');
		}
		//var_dump($paciente);
		
		
		return View::make('pacientes.ficha')->with('paciente',$paciente);
	 }
	 
	 
	 public function show()
	{
		//echo "HOLA";
		return View::make('pacientes.buscar');
		
	}


	public function verficha($numerohistoria)
	{
		//$paciente = Pacientes::on('quiron')->where('numerohistoria', $numerohistoria)->get();
		$paciente = Pacientes::where('numerohistoria', $numerohistoria)->get();

		$companias = Companias::lists('nombre', 'id');
		//var_dump($paciente);
		return View::make('pacientes.verficha')->with('paciente',$paciente)->with(array('companias' => $companias));
	}
		
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editarficha($id)
	{
		
		$paciente = Input::get();
		var_dump($paciente);
		$editarpaciente = new Pacientes;
		$editarpaciente->nombre = $paciente['nombre'];
		$editarpaciente->save();
		$paciente_editado = Pacientes::find($id);
		var_dump($paciente_editado);
		
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
