<?php

class Historial_clinicoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
//	    $sede_id = Input::get('sede');
//            $sede = Sedes::find($sede_id);
//            $profesionales = Profesional::lists('apellido1', 'id');	
            return View::make('historial.buscar')/*->with(array('profesionales' => $profesionales))->with('sede', $sede)*/;
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
		$paciente_id = Input::get('paciente_id');

            $historial = new Historial_clinico;
            $historial->tratamiento_id = Input::get('s_tratamientos');
            $historial->profesional_id = Input::get('profesional_id');
            $historial->paciente_id = $paciente_id;
            $fecha_r = Input::get('fecha_realizacion');
            $fecha_r_f = explode('/', $fecha_r);
            $historial->fecha_realizacion = $fecha_r_f[2]."-".$fecha_r_f[1]."-".$fecha_r_f[0];
            $historial->cobrado_paciente = Input::get('cobrado_paciente', 0);
            $historial->abonado_quiron = Input::get('abonado_quiron', 0);
            $historial->cobrado_profesional = Input::get('cobrado_profesional', 0);
            $historial->save();

            return Redirect::to('historial_clinico/'.$paciente_id);
    }


	// Construye un array para javascript de crear/editar presupuesto
	private function getTratamientosArray($grupos, $companias, $companias_paciente) {

		$preciosObj = Precios::whereIn('companias_id', array_keys($companias))->get(array('tratamientos_id', 'precio', 'companias_id'));
		$precios = array();
		$companiaEconomica = array();

		// Escoge el precio más barato de las dos compañías
		foreach ($preciosObj as $p)
		{
			if (!(array_key_exists($p->tratamientos_id, $precios)) ||
				((array_key_exists($p->tratamientos_id, $precios)) && ($p->precio < $precios[$p->tratamientos_id]))) {

				$precios[$p->tratamientos_id][$p->companias_id] = $p->precio;
			}

			if (in_array($p->companias_id, $companias_paciente)) {
				if (!(array_key_exists($p->tratamientos_id, $companiaEconomica)) ||
					((array_key_exists($p->tratamientos_id, $companiaEconomica)) && ($p->precio < $precios[$p->tratamientos_id][$companiaEconomica[$p->tratamientos_id]]))) {

					$companiaEconomica[$p->tratamientos_id] = $p->companias_id;
				}
			}
		}

		$tratamientosAll = Tratamientos::get(array('nombre', 'id', 'grupostratamientos_id', 'tipostratamientos_id'));

		$atratamientos = array();
		foreach ($tratamientosAll as $t) {
			// No mostrar el tratamiento si no tiene precio asignado en las compañías del paciente
			if (array_key_exists($t->id, $precios)) {
				$ta = array('id' => $t->id, 'nombre' => $t->nombre, 'compania_economica' => $companiaEconomica[$t->id],
							'precios' => $precios[$t->id], 'tipo' => $t->tipostratamientos_id);
				$atratamientos[$t->grupostratamientos_id][$t->id] = $ta;
			}
		}

		return $atratamientos;
	}

	/* */
	private function _data_aux_historial($paciente) {

		$companias_list = Companias::lists('nombre', 'id');
		$companias_paciente = array();
		$companias_paciente[] = $paciente->compania;

		$paciente->companias_text = $companias_list[$paciente->compania];
		if ($paciente->compania2 != 0) {
			$companias_paciente[] = $paciente->compania2;
			$paciente->companias_text .= ' y ' . $companias_list[$paciente->compania2];
		}

		$grupos = Grupos::orderBy('id')->get(array('id', 'nombre'));

		$atratamientos = $this->getTratamientosArray($grupos, $companias_list, $companias_paciente);

		return array('grupos' => $grupos,
					'paciente' => $paciente,
					'atratamientos' => $atratamientos,
					'companias' => $companias_list);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$paciente = Pacientes::where('id', $id)->firstOrFail();
		$user = Auth::id();
		$profesional = Profesional::where('user_id', $user)->firstOrFail();
        $historiales = Historial_clinico::where('paciente_id', $paciente->id)
                ->leftJoin('tratamientos', 'historial_clinico.tratamiento_id', '=', 'tratamientos.id')
                ->leftJoin('precios','historial_clinico.tratamiento_id', '=', 'precios.tratamientos_id')->where('precios.companias_id','=', $paciente->compania)
                ->leftJoin('profesionales', 'historial_clinico.profesional_id', '=', 'profesionales.id' )
                ->select('historial_clinico.*', 'profesionales.nombre as pr_n', 'profesionales.apellido1 as pr_a1', 'profesionales.apellido2 as pr_a2', 'precios.precio',
                'tratamientos.nombre as t_n')
                ->where('precios.companias_id', $paciente->compania)
                ->orderBy('fecha_realizacion', 'DESC')
                ->get();


		$data = $this->_data_aux_historial($paciente);

        return View::make('historial.historial')->with($data)
												->with(array('historiales' => $historiales, 'profesional' => $profesional));

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
	 public function busqueda()
	 {
		$busca = Input::get('nombre');
		if($busca) {
			$busca = '%'.$busca.'%';
			$pacientes = Pacientes::where('nombre', 'LIKE', $busca)
									->orWhere('apellido1', 'LIKE', $busca)
									->orWhere('apellido2', 'LIKE', $busca)
									->orWhere('numerohistoria', 'LIKE', $busca)
									->get();


		} else {
		  return Redirect::to('historial/buscar')->withMesage('Paciente no encontrado');
		}
		//var_dump($paciente);


		return View::make('historial.busqueda')->with('pacientes', $pacientes);
	 }


	 public function buscar()
	{
		//echo "HOLA";
		return View::make('historial.buscar');

	}


}
