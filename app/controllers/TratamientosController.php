<?php

class TratamientosController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$companias = Companias::select('nombre')->get();
		$tratamientos = Tratamientos::select('id', 'codigo', 'nombre', 'precio_base')->get();
		$precios = Precios::select('tratamientos_id', DB::raw('GROUP_CONCAT(precios.precio order by companias_id) as precios'))->groupBy('tratamientos_id')->get();

		foreach($precios as $p) {
			//$tratamientos[$p->tratamientos_id]->precios = explode(",", $p->precios);
			$tratamientos[$p->tratamientos_id-1]->precios = $p->precios;
		}

		return View::make('tratamientos.index')->with(array('companias' => $companias, 'tratamientos' => $tratamientos));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$grupos = Grupos::lists('nombre', 'id');
		return View::make('tratamientos.crear')->with(array('grupos' => $grupos));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$tratamiento = Tratamientos::create(Input::all());
        $companias_ids = Companias::lists('id');

		foreach($companias_ids as $cid){
			$tratamiento->companias()->attach(array('precio' => '0.00' , 'companias_id'=>$cid, 'tratamientos_id'=>$tratamiento->id));
		}

		return Redirect::to('tratamientos');
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
		$tratamiento = Tratamientos::where('id', $id)->first();
		$precios = Precios::leftJoin('tratamientos', 'tratamientos.id', '=', 'tratamientos_id')
			->leftJoin('companias', 'companias.id','=','companias_id')
			->select('companias.nombre as nombre_comp', 'companias.id', 'precio')
			->where('tratamientos.id' , $tratamiento->id)
			->get();
		return View::make('tratamientos.editar')->with('tratamiento', $tratamiento)->with('tcp' , $precios);
	}

	public function editar_t($id){
		$guardar_t = Input::all();
		var_dump($guardar_t);
		$nombre = $guardar_t;

		return Redirect::to('tratamientos');
	}

	public function editarprecios($id)
	{
		$tcp = Input::all();
		var_dump($tcp);
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
