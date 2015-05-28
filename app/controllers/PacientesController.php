<?php

class PacientesController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$pacientes = Pacientes::whereRaw('pacientes.created_at >= DATE_SUB(NOW(), INTERVAL 100 DAY)')
                                ->orderBy('pacientes.created_at')
                                ->get();
        $profesionales = Profesional::select(DB::raw("CONCAT_WS(' ', nombre, apellido1, apellido2) AS nombre"), 'id')->lists('nombre', 'id');
		return View::make('pacientes.index')->with(array('profesionales' => $profesionales, 'pacientes' => $pacientes));
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
			$nuevo_paciente = Pacientes::create(Input::all());
			return Redirect::action('PacientesController@index')->with('message', 'Paciente creado con éxito.');
		} else {
			return Redirect::action('PacientesController@create')->with('message', 'Existen los siguientes errores:')
																 ->withErrors($validator)->withInput();
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

			$busca = '%'.$busca.'%';
			$pacientes = Pacientes::select('pacientes.id', 'numerohistoria', 'nombre', 'apellido1', 'apellido2', 'admitido')
									->where('nombre', 'LIKE', $busca)
									->orWhere('apellido1', 'LIKE', $busca)
									->orWhere('apellido2', 'LIKE', $busca)
									->orWhere('numerohistoria', 'LIKE', $busca)
									->leftJoin('espera', 'espera.paciente_id', '=', 'pacientes.id')
									->get();
			$profesionales = Profesional::select(DB::raw("CONCAT_WS(' ', nombre, apellido1, apellido2) AS nombre"), 'id')->lists('nombre', 'id');

		} else {
			return Redirect::action('PacientesController@buscar');
		}

		return View::make('pacientes.busqueda')->with('pacientes', $pacientes)->with('profesionales', $profesionales);
	 }


	public function buscar() {
		return View::make('pacientes.buscar');
	}

	public function show($id)
	{
		//$paciente = Pacientes::on('quiron')->where('numerohistoria', $numerohistoria)->get();
		$paciente = Pacientes::where('id', $id)->get();

		$companias = Companias::lists('nombre', 'id');
        asort($companias);
		return View::make('pacientes.verficha')->with('paciente',$paciente)->with(array('companias' => $companias));
	}

	public function edit($id)
	{
		//$paciente = Pacientes::on('quiron')->where('numerohistoria', $numerohistoria)->get();
		$paciente = Pacientes::where('id', $id)->get();

		$companias = Companias::lists('nombre', 'id');
        asort($companias);
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
		return Redirect::action('PacientesController@index')->with('message', 'Paciente modificado con éxito.');
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
