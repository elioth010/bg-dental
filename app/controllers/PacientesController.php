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
		$pacientes = Pacientes::whereRaw('pacientes.created_at >= DATE_SUB(NOW(), INTERVAL 100 DAY)')
                                ->leftJoin('espera', 'espera.paciente_id', '=', 'pacientes.id')
                                ->select('pacientes.*','espera.admitido')
                                ->groupBy('pacientes.id')
                                ->orderBy('pacientes.created_at')
                                ->get();
                
		//$pacientes = Pacientes::all();
		return View::make('pacientes.index', array('pacientes' => $pacientes));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
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


		$validator = Validator::make(Input::all(), Pacientes::$p_rules);

		if ($validator->passes()) {
			$crear_p = Pacientes::create(Input::all());
			return Redirect::to('paciente')->with('message', 'Paciente creado con éxito.');
		} else {
			return Redirect::to('paciente/create')->with('message', 'Existen los siguientes errores:')->withErrors($validator)->withInput();
		}
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
		  $paciente = Pacientes::whereRaw('nombre LIKE "%'.$busca.'%" or apellido1 LIKE "%'.$busca.'%"  or apellido2 LIKE "%'.$busca.'%"  or numerohistoria LIKE "%'.$busca.'%" ')
                          ->leftJoin('espera', 'espera.paciente_id', '=', 'pacientes.id')
                          ->get();
		  

		  
		} else {
		  return Redirect::to('paciente/buscar');
		}
		//var_dump($paciente);


		return View::make('pacientes.busqueda')->with('paciente', $paciente);
	 }
	 
	 
	 public function buscar()
	{
		//echo "HOLA";
		return View::make('pacientes.buscar');
		
	}

        public function show($id)
	{
		//$paciente = Pacientes::on('quiron')->where('numerohistoria', $numerohistoria)->get();
		$paciente = Pacientes::where('id', $id)->get();

		$companias = Companias::lists('nombre', 'id');
                asort($companias);
		//var_dump($paciente);
		return View::make('pacientes.verficha')->with('paciente',$paciente)->with(array('companias' => $companias));
	}
        
	public function edit($id)
	{
		//$paciente = Pacientes::on('quiron')->where('numerohistoria', $numerohistoria)->get();
		$paciente = Pacientes::where('id', $id)->get();

		$companias = Companias::lists('nombre', 'id');
                asort($companias);
		//var_dump($paciente);
		return View::make('pacientes.verficha')->with('paciente',$paciente)->with(array('companias' => $companias));
	}
		
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		
		$paciente = Pacientes::find($id);
                $paciente->update(Input::all());
                return Redirect::to('paciente')->with('message', 'Paciente modificado con éxito.');
                //$paciente->save();
		//var_dump($paciente_d);
//		$editarpaciente = new Pacientes;
//		$editarpaciente->nombre = $paciente['nombre'];
//		$editarpaciente->save();
//		$paciente_editado = Pacientes::find($id);
//		var_dump($paciente_editado);
		
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
//	public function update($id)
//	{
//		//
//	}


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
