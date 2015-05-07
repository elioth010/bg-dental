<?php

class Historial_clinicoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	    $sede_id = Input::get('sede');
            $sede = Sedes::find($sede_id);
            $profesionales = Profesional::lists('apellido1', 'id');	
            return View::make('historial.buscar')->with(array('profesionales' => $profesionales))->with('sede', $sede);
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
                Historial_clinico::create(Input::all());
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
                        ->leftJoin('precios','historial_clinico.tratamiento_id' , '=', 'precios.tratamientos_id' )
                        ->where('precios.companias_id', $paciente->compania)
                        ->get();
                $grupos = Grupos::orderBy('id')->lists('nombre', 'id');
                $tratamientos = Tratamientos::lists('nombre','id');
                $profesional = Profesional::where('user_id', $user)->first();
                return View::make('historial.historial')->with('paciente', $paciente)->with('historial', $historial)
                        ->with('grupos', $grupos)->with('tratamientos', $tratamientos)->with('profesional', $profesional)
                        ->with('compania', $compania);
                
                
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
		  //$paciente = Pacientes::on('quiron')->whereRaw('nombre LIKE "%'.$busca.'%" or apellido1 LIKE "%'.$busca.'%"  or apellido2 LIKE "%'.$busca.'%"  or numerohistoria LIKE "%'.$busca.'%" ')->get();
		  $paciente = Pacientes::whereRaw('nombre LIKE "%'.$busca.'%" or apellido1 LIKE "%'.$busca.'%"  or apellido2 LIKE "%'.$busca.'%"  or numerohistoria LIKE "%'.$busca.'%" ')->get();
		  

		  
		} else {
		  return Redirect::to('historial/buscar')->withMesage('Paciente no encontrado');
		}
		//var_dump($paciente);


		return View::make('historial.busqueda')->with('paciente', $paciente);
	 }
	 
	 
	 public function buscar()
	{
		//echo "HOLA";
		return View::make('historial.buscar');
		
	}
	

}
