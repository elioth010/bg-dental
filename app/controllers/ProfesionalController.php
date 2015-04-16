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
                        ->leftJoin('sedes_profesionales', 'sedes_profesionales.profesional_id','=','profesionales.id')
                        ->leftJoin('sedes', 'sedes.id', '=', 'sedes_profesionales.sede_id')
                                ->groupBy('profesionales.id')
                        ->select('sedes.nombre','profesionales.*','especialidades.*', DB::raw('GROUP_CONCAT(sedes.nombre) as sedes_p'))->get();
//        var_dump($profesionales);
//                return;
                $sedes = Sedes::get();
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
		$profesional = new Profesional;
    $profesional->nombre = Input::get('nombre');
    $profesional->apellido1 = Input::get('apellido1');
    $profesional->apellido2 = Input::get('apellido2');
    $profesional->especialidades_id = Input::get('especialidades_id');
    $profesional->save();
                $sedes = Sedes::count();
                $i = 1;
                while($i<=$sedes){
                    if(Input::has('sede-'.$i)){
                    $sede_profesional = Input::get('sede-'.$i);
                    $profesional->sedes()->attach($sede_profesional);
                    }
                    $i++;
                    }
                
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
