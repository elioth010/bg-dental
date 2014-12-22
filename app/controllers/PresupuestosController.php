<?php

class PresupuestosController extends \BaseController {

	public function findTratamiento($grupoID){
		$tratamientos = Tratamientos::where('grupos_tratamientos_id', $grupoID)->lists('nombre', 'id');
		return $tratamientos;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function crearpresupuesto($numerohistoria)
	{
		echo $numerohistoria;
		$paciente = Pacientes::where('numerohistoria', $numerohistoria)->first();

		$grupos = Grupos::lists('nombre', 'id');
		$grupos[0] = '-- Elija un grupo --';
		ksort($grupos);

		$tratamientosAll = DB::table('tratamientos')->select('nombre', 'id', 'grupostratamientos_id')->get();
		$tratamientos = array();
		foreach ($tratamientosAll as $t) {
			//var_dump($t);
			$tratamientos[$t->grupostratamientos_id][] = array('id' => $t->id, 'nombre' => $t->nombre);
		}

		$tratamientos[0] = '-- Elija primero un grupo de tratamientos --';

		foreach (array_keys($grupos) as $key) {
			if (!array_key_exists($key, $tratamientos)) {
				$tratamientos[$key] = array(array('id' => 0, 'nombre' => '-- No hay tratamiento --'));
			}
		}
		ksort($tratamientos);

		return View::make('presupuestos.crearpresupuesto')
							->with(array('grupos' => $grupos,
										'paciente' => $paciente,
										'tratamientos' => $tratamientos));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$presupuesto = Presupuestos::create(Input::all());
		return Redirect::action('PresupuestosController@verpresupuestos', array('numerohistoria' => $presupuesto->numerohistoria));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function verpresupuestos($numerohistoria)
	{
		//$paciente_q = Pacientes::on('quiron')->where('numerohistoria',$numerohistoria)->first()->toArray();
		$paciente_q = Pacientes::where('numerohistoria',$numerohistoria)->first()->toArray();
		$paciente_b = Pacientes::where('numerohistoria',$numerohistoria)->first();
		if(!$paciente_b) {
		Pacientes::create($paciente_q);
		echo "Paciente creado!";
		} else {
		echo "Paciente ya existe";
		}
		$paciente_b = Pacientes::where('numerohistoria',$numerohistoria)->first();
		$presupuestos = Presupuestos::where('numerohistoria',$numerohistoria)
			->leftJoin('users', 'users.id', '=', 'user_id')
			->leftJoin('presupuestos_tratamientos', 'presupuestos_tratamientos.presupuesto_id', '=', 'presupuestos.id')
			->leftJoin('tratamientos' , 'tratamientos.id', '=', 'presupuestos_tratamientos.tratamiento_id')
			->leftJoin('profesionales', 'profesionales.id', '=', 'presupuestos.profesional_id')
			->select('aceptado','presupuesto_id','presupuestos.created_at as creado', 'presupuestos.updated_at as modificado', 'presupuestos.nombre as nombre_p',
			'profesionales.nombre as profesional',
			'users.firstname as nombre_u')->groupBy('presupuesto_id')
			->get();
			var_dump($presupuestos);
		$total = 1;
		foreach ($presupuestos as $key) {
			$id = $presupuestos['0']['presupuesto_id'];
			$total = Tratamientos::where('presupuestos_tratamientos.presupuesto_id', $id)->leftJoin('presupuestos_tratamientos', 'presupuestos_tratamientos.tratamiento_id', '=', 'tratamientos.id')
			->sum('tratamientos.precio_base');
		var_dump($total);
		}
		
	


		
		return View::make('presupuestos.presupuestos')->with('paciente',$paciente_b)->with(array('presupuestos' => $presupuestos))->with(array('total' => $total));
// 		    $paciente_b = new Pacientes;
// 		    $paciente_b->numerohistoria = $paciente_q->numerohistoria;
// 		    $paciente_b->nombre = $paciente_q->nombre;
// 		    $paciente_b->apellido1 = $paciente_q->apellido1;
// 		    $paciente_b->apellido2 = $paciente_q->apellido2;
// 		    $paciente_b->NIF = $paciente_q->NIF;
// 		    $paciente_b->fechanacimiento = $paciente_q->fechanacimiento;
// 		    $paciente_b->sexo = $paciente_q->sexo;
// 		    $paciente_b->Direccion = $paciente_q->Direccion;
// 		    $paciente_b->addrnamestre = $paciente_q->addrnamestre;
// 		    $paciente_b->addrtel1 = $paciente_q->addrtel1;
// 		    $paciente_b->addrtel2 = $paciente_q->addrtel2;
// 		    $paciente_b->terrdesc = $paciente_q->terrdesc;
// 		    $paciente_b->addrpostcode = $paciente_q->addrpostcode;
// 		    $paciente_b->save();
// 		    var_dump($paciente_b);
		  
		
		
// 		Pacientes::create(array($paciente_q));
		
// 		$paciente_b = Pacientes::find($id);
// 		var_dump($paciente_b);
// 		
		//echo $paciente_q->numerohistoria;
// 		$paciente_b = new Pacientes;
// 		$paciente_b = $paciente_q;
		//$paciente_b = $paciente_q;
// 		Pacientes::create($paciente_b);
// 		var_dump($paciente_b);
// 		
		//$paciente_b = new Pacientes;
		//Paciente_b->numerohistoria = $paciente_q('numerohistoria');
		//var_dump($paciente_q->toArray());
		//Pacientes::create($paciente_b);
		
		//$paciente_b = Pacientes::where('id', $id)->get();
		
		//print_r($paciente_q);
		//Pacientes::firstOrCreate($paciente_b);
		
		//$presupuesto = Presupuestos::where(get();
		//return View::make('pacientes.verficha')->with('paciente',$paciente);
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
