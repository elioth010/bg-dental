<?php

class PresupuestosController extends \BaseController {

	public function findTratamiento($grupoID) {
		$tratamientos = Tratamientos::where('grupos_tratamientos_id', $grupoID)->lists('nombre', 'id');
		return $tratamientos;
	}

	public function imprimirPDF($paciente, $id) {
		$data = $this->_imprimirPresupuesto($paciente, $id);
		$data['showpdf'] = false;
		$html = View::make('presupuestos.imprimirpresupuesto')->with($data);
		return PDF::load($html, 'A4', 'portrait')->download($paciente);
	}

	public function verPDF($paciente, $id) {
		$data = $this->_imprimirPresupuesto($paciente, $id);
		$data['showpdf'] = false;
		$html = View::make('presupuestos.imprimirpresupuesto')->with($data);
		return PDF::load($html, 'A4', 'portrait')->show();
	}

	public function imprimirPresupuesto($paciente, $id) {
		$data = $this->_imprimirPresupuesto($paciente, $id);
		$data['showpdf'] = true;
		return View::make('presupuestos.imprimirpresupuesto')->with($data);
	}


	private function _imprimirPresupuesto($paciente, $id) {
		$presupuesto = Presupuestos::find($id);
		$tratamientos = $presupuesto->tratamientos()->get(array('presupuestos_tratamientos.*', 'tratamientos.nombre'));
		$companias_list = Companias::lists('nombre', 'id');
		$total = 0;

		foreach($tratamientos as $t) {
			$t->precio_unidad = $t->precio_final / $t->unidades;

			if ($t->tipodescuento == 'P') {
				$descuento = $t->descuento * $t->precio_final / 100;
				$descuentotext = $t->descuento . '%';
			} else {
				$descuento = $t->descuento;
				$descuentotext = $t->descuento . '€';
			}

			$t->precio_final -= $descuento;
			$t->descuento_text = $descuentotext;
			$t->compania_text = $companias_list[$t->compania_id];

			if ($t->estado == 1) {
				$t->estado_text = 'Aceptado';
			} else {
				$t->estado_text = 'Pendiente de aprobación';
			}

			$total += $t->precio_final;
		}

		return array ('presupuesto' => $presupuesto, 'tratamientos'=> $tratamientos, 'total' => $total, 'paciente' => $paciente);
	}

	public function verPresupuesto($paciente, $id) {
		$presupuesto = Presupuestos::find($id);
		$tratamientos = $presupuesto->tratamientos()->get(array('presupuestos_tratamientos.*', 'tratamientos.nombre'));
		$companias_list = Companias::lists('nombre', 'id');
		$total = 0;

		foreach($tratamientos as $t) {
			$t->precio_unidad = $t->precio_final / $t->unidades;

			if ($t->tipodescuento == 'P') {
				$descuento = $t->descuento * $t->precio_final / 100;
				$descuentotext = $t->descuento . '%';
			} else {
				$descuento = $t->descuento;
				$descuentotext = $t->descuento . '€';
			}

			$t->precio_final -= $descuento;
			$t->descuento_text = $descuentotext;
			$t->compania_text = $companias_list[$t->compania_id];

			if ($t->estado == 1) {
				$t->estado_text = 'Aceptado';
			} else {
				$t->estado_text = 'Pendiente de aprobación';
			}

			$total += $t->precio_final;
		}

		return View::make('presupuestos.verpresupuesto')->with(array('presupuesto' => $presupuesto,
																	 'tratamientos' => $tratamientos,
																	 'total' => $total,
																	 'paciente' => $paciente));
	}

	public function borrarPresupuesto($paciente, $id) {
		$presupuesto = Presupuestos::where('id', $id)->where('aceptado', 0)->firstOrFail();
		$presupuesto->tratamientos()->detach();
		$presupuesto->delete();

		return Redirect::action('PresupuestosController@verpresupuestos', array($paciente))
						->with('message', '¡Presupuesto borrado!');
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

	// Construye un array para javascript de crear/editar presupuesto
	private function getTratamientosArray($grupos, $companias) {

		$preciosObj = Precios::whereIn('companias_id', array_keys($companias))->get(array('tratamientos_id', 'precio', 'companias_id'));
		$precios = array();
		$companiaEconomica = array();

		// Escoge el precio más barato de las dos compañías
		foreach ($preciosObj as $p)
		{
			if (!(array_key_exists($p->tratamientos_id, $precios)) ||
				((array_key_exists($p->tratamientos_id, $precios)) && ($p->precio < $precios[$p->tratamientos_id]))) {

				$precios[$p->tratamientos_id] = $p->precio;
				$companiaEconomica[$p->tratamientos_id] = $p->companias_id;
			}
		}

		$tratamientosAll = Tratamientos::get(array('nombre', 'id', 'grupostratamientos_id', 'tipostratamientos_id'));

		$atratamientos = array();
		foreach ($tratamientosAll as $t) {
			// No mostrar el tratamiento si no tiene precio asignado en las compañías del paciente
			if (array_key_exists($t->id, $precios)) {
				$ta = array('id' => $t->id, 'nombre' => $t->nombre, 'compania' => $companiaEconomica[$t->id],
							'precio' => $precios[$t->id], 'tipo' => $t->tipostratamientos_id);
				$atratamientos[$t->grupostratamientos_id][$t->id] = $ta;
			}
		}

		return $atratamientos;
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function crearpresupuesto($numerohistoria)
	{
		$paciente = Pacientes::where('numerohistoria', $numerohistoria)->first();
		$companias_list = Companias::lists('nombre', 'id');

		$paciente->companias_text = $companias_list[$paciente->compania];
		$companias = array();
		$companias[$paciente->compania] = $companias_list[$paciente->compania];
		if ($paciente->compania2 != 0) {
			$paciente->companias_text .= ' y ' . $companias_list[$paciente->compania2];
			$companias[$paciente->compania2] = $companias_list[$paciente->compania2];
		}

		$grupos = Grupos::orderBy('id')->get(array('id', 'nombre'));

		$atratamientos = $this->getTratamientosArray($grupos, $companias);

		$presupuesto = new Presupuestos;
		$presupuesto->descuento = 0; // valor por defecto

		$profesionales1 = Profesional::get(array(DB::raw("CONCAT_WS(' ', nombre, apellido1, apellido2) AS nombre"), 'id'));

		$profesionales = array();
		foreach ($profesionales1 as $p){
			$profesionales[$p->id] = $p->nombre;
		}

		$tratamientos = array();
		if (!is_null(Input::old('num_tratamientos'))) {
			for ($i=1; $i <= Input::old('num_tratamientos'); $i++) {
				$tratamientos[] = array('grupo' => Input::old('grupo-' . $i), 'tratamiento_id' => Input::old('tratamiento-' . $i));
			}
		}

		return View::make('presupuestos.crearpresupuesto')
							->with(array('grupos' => $grupos,
										'paciente' => $paciente,
										'atratamientos' => $atratamientos,
										'tratamientos' => $tratamientos,
										'presupuesto' => $presupuesto,
										'companias' => $companias,
										'profesionales' => $profesionales));
	}


	/**
	* Usa la misma plantilla de crear presupuesto para editarlo
	*
	* @return Response
	*/
	public function editarPresupuesto($numerohistoria, $presupuesto)
	{
		$presupuesto = Presupuestos::where('id', $presupuesto)->where('numerohistoria', $numerohistoria)
									->where('aceptado', 0)->firstOrFail();
		$paciente = $presupuesto->paciente;
		$companias_list = Companias::lists('nombre', 'id');

		$paciente->companias_text = $companias_list[$paciente->compania];
		$companias = array();
		$companias[$paciente->compania] = $companias_list[$paciente->compania];
		if ($paciente->compania2 != 0) {
			$paciente->companias_text .= ' y ' . $companias_list[$paciente->compania2];
			$companias[$paciente->compania2] = $companias_list[$paciente->compania2];
		}

		$grupos = Grupos::orderBy('id')->get(array('id', 'nombre'));

		$atratamientos = $this->getTratamientosArray($grupos, $companias);

		$tratamientos = $presupuesto->tratamientos()
									->get(array('tratamiento_id', 'grupostratamientos_id', 'precio_final', 'piezas', 'unidades'));

		$profesionales1 = Profesional::get(array(DB::raw("CONCAT_WS(' ', nombre, apellido1, apellido2) AS nombre"), 'id'));
		$profesionales = array();
		foreach ($profesionales1 as $p){
			$profesionales[$p->id] = $p->nombre;
		}

		return View::make('presupuestos.crearpresupuesto')
							->with(array('grupos' => $grupos,
										'paciente' => $paciente,
										'atratamientos' => $atratamientos,
										'tratamientos' => $tratamientos,
										'presupuesto' => $presupuesto,
										'companias' => $companias,
										'profesionales' => $profesionales));
	}

	public function aceptarPresupuesto($numerohistoria, $presupuesto) {
		$presupuesto = Presupuestos::where('id', $presupuesto)->where('numerohistoria', $numerohistoria)
									->where('aceptado', 0)->firstOrFail();
		$presupuesto->aceptado = 1;
		$presupuesto->save();
		return Redirect::action('PresupuestosController@verpresupuestos', array($numerohistoria))
						->with('message', '¡Presupuesto aceptado!');
	}

	public function aceptarTratamientoPresupuesto($numerohistoria, $presupuesto_id, $tratamiento_id) {
		$presupuesto = Presupuestos::where('id', $presupuesto_id)->where('numerohistoria', $numerohistoria)->firstOrFail();
		$presupuesto->tratamientos2()->updateExistingPivot($tratamiento_id, array('estado' => 1));

		return Redirect::action('PresupuestosController@verPresupuesto', array($numerohistoria, $presupuesto_id))
						->with('message', '¡Tratamiento realizado!');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$numero_historia = Input::get('numerohistoria');
		$num = Input::get('num_tratamientos');

		$validator = Validator::make(Input::all(), Presupuestos::$p_rules);

		if ($validator->passes()) {
			$nombre = Input::get('nombre', 'Sin nombre');
			if (empty($nombre)) {
				$nombre = 'Sin nombre';
			}

			$presupuesto = Presupuestos::firstOrNew(array('id' => Input::get('presupuesto_id')));
			$presupuesto->nombre = $nombre;
			$presupuesto->aceptado = 0;
			$presupuesto->user_id = Session::get('user_id');
			$presupuesto->profesional_id = Input::get('tprofesional');
			$presupuesto->numerohistoria = $numero_historia;
			$presupuesto->descuento = Input::get('descuento');
			$presupuesto->tipodescuento = Input::get('tipodescuento');

			//var_dump($presupuesto);return;
			if ($presupuesto->save()) {
				echo 'Guardado presupuesto con id ' . $presupuesto->id . '<br>';
			}

			$presupuesto->tratamientos()->detach();

			$precios = Precios::paciente($numero_historia);

			for ($i=1; $i<=$num; $i++) {
				$grupo = Input::get('grupo-' . $i, 0);
				if ($grupo == 0) {
					continue;
				}
				$t_id = Input::get('tratamiento-' . $i);
				$t_unidades =  Input::get('iunidades-' . $i, 1);
				$t_desc = Input::get('descuento-' . $i, 0);
				$t_tdesc = Input::get('tipodescuento-' . $i, 'E');
				$t_piezas = Input::get('ipiezas-' . $i);
				$t_compania = Input::get('compania-' . $i);
				$t_precio = $precios[$t_id][$t_compania];
				$t_preciof = Input::get('preciof-' . $i);

				$pt = array('presupuesto_id' => $presupuesto->id, 'tratamiento_id' => $t_id,
							'unidades' => $t_unidades, 'piezas' => $t_piezas,
							'descuento' => $t_desc, 'tipodescuento' => $t_tdesc,
							'compania_id' => $t_compania,
							'precio_final' => $t_preciof);

				$presupuesto->tratamientos()->attach($presupuesto->id, $pt);
			}

		} else {
			return Redirect::action('PresupuestosController@editarPresupuesto', array('numerohistoria' => $numero_historia))->with('message', 'Existen los siguientes errores:')->withErrors($validator->messages())->withInput();
		}


		//return Redirect::action('PresupuestosController@editarPresupuesto', array('numerohistoria' => $numero_historia))->with('message', 'Presupuesto creado con éxito.');
		return Redirect::action('PresupuestosController@verpresupuestos', array('numerohistoria' => $numero_historia))->with('message', 'Presupuesto creado con éxito.');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function verpresupuestos($numerohistoria)
	{
		/*
		$paciente_q = Pacientes::on('quiron')->where('numerohistoria',$numerohistoria)->first()->toArray();
		$paciente_b = Pacientes::where('numerohistoria',$numerohistoria)->first();
		if(!$paciente_b) {
		Pacientes::create($paciente_q);
		echo "Paciente creado!";
		} else {
		echo "Paciente ya existe";
		}
		*/
		$paciente_b = Pacientes::where('numerohistoria',$numerohistoria)->first();
		$companias_list = Companias::lists('nombre', 'id');
		$paciente_b->companias_text = $companias_list[$paciente_b->compania];

		if ($paciente_b->compania2 != 0) {
			$paciente_b->companias_text .= ' y ' . $companias_list[$paciente_b->compania2];
		}

		$profesionales1 = Profesional::get(array(DB::raw("CONCAT_WS(' ', nombre, apellido1, apellido2) AS nombre"), 'id'));
		$profesionales = array();
		foreach ($profesionales1 as $p){
			$profesionales[$p->id] = $p->nombre;
		}
		$users1 = User::get(array(DB::raw("CONCAT_WS(' ', firstname, lastname) AS nombre"), 'id'));
		$users = array();
		foreach ($users1 as $u){
			$users[$u->id] = $u->nombre;
		}

		$presupuestos = Presupuestos::where('numerohistoria',$numerohistoria)->orderBy('updated_at', 'desc')->get();

		$precios = Precios::paciente($numerohistoria);

		foreach ($presupuestos as $p) {
			$total = 0;

			$tratamientos = $p->tratamientos()->get(array('presupuestos_tratamientos.*', 'tratamientos.nombre'));

			foreach ($tratamientos as $t) {
				$total += $t->precio_final;
			}

			if ($p->tipodescuento == 'P') {
				$descuento = $p->descuento * $total / 100;
				$descuentotext = $p->descuento . '%';
			} else {
				$descuento = $p->descuento;
				$descuentotext = $p->descuento . '€';
			}

			$p->importe_total = $total - $descuento;
			$p->descuentototal = $descuentotext;
			$p->profesional_n = $profesionales[$p->profesional_id];
			$p->user_n = $users[$p->user_id];
		}

		return View::make('presupuestos.presupuestos')->with('paciente',$paciente_b)
										->with(array('presupuestos' => $presupuestos));
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
