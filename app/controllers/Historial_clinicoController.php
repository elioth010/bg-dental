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
            // [tratamiento_id] => 2 [profesional_id] => 3 [paciente_id] => 1 [fecha_realizacion] => 05/31/2015 [cobrado_paciente] => 3 [abonado_quiron] => 1 [cobrado_profesional] => 1 )
            //print_r($_POST);
            $historial = new Historial_clinico;
            $historial->tratamiento_id = Input::get('tratamiento_id');
            $historial->profesional_id = Input::get('profesional_id');
            $historial->paciente_id = Input::get('paciente_id');
            $fecha_r = Input::get('fecha_realizacion');
            $fecha_r_f = explode('/', $fecha_r);
            $historial->fecha_realizacion = $fecha_r_f[2]."-".$fecha_r_f[0]."-".$fecha_r_f[1];
            $historial->cobrado_paciente = Input::get('cobrado_paciente');
            $historial->abonado_quiron = Input::get('abonado_quiron');
            $historial->cobrado_profesional = Input::get('cobrado_profesional');
            $historial->save();
            $paciente_id = Input::get('paciente_id');
//                $historial = Input::all();
//                var_dump($historial);
            return Redirect::to('historial_clinico/'.$paciente_id);
        }


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user =  Auth::id();
                $paciente = Pacientes::find($id);
                $compania = Companias::find($paciente->compania);
                $historial = Historial_clinico::where('paciente_id', $paciente->id)
                        ->leftJoin('tratamientos', 'historial_clinico.tratamiento_id', '=', 'tratamientos.id')
                        ->leftJoin('precios','historial_clinico.tratamiento_id', '=', 'precios.tratamientos_id')->where('precios.companias_id','=', $paciente->compania)
                                    
                        ->leftJoin('profesionales', 'historial_clinico.profesional_id', '=', 'profesionales.id' )
                        ->select('historial_clinico.*', 'profesionales.nombre as pr_n', 'profesionales.apellido1 as pr_a1', 'profesionales.apellido2 as pr_a2', 'precios.precio',
                        'tratamientos.nombre as t_n')
                        ->where('precios.companias_id', $paciente->compania)
                        ->orderBy('fecha_realizacion', 'DESC')
                        ->get();
                $grupos = Grupos::orderBy('id')->lists('nombre', 'id');
                $tratamientos = Tratamientos::lists('nombre','id');
                $profesional = Profesional::where('user_id', $user)->firstOrFail();
                return View::make('historial.historial')->with('paciente', $paciente)->with('historial', $historial)
                        ->with('grupos', $grupos)->with('tratamientos', $tratamientos)->with('profesional', $profesional)
                        ->with('compania', $compania);

        //var_dump($historial);
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
