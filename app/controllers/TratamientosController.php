<?php

class TratamientosController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//$companias_cabecera = Companias::orderBy('nombre')->all();
		$tcp_cabecera = Precios::leftJoin('tratamientos', 'tratamientos.id', '=', 'tratamientos_id')
					->leftJoin('companias', 'companias.id','=','companias_id')
					->leftJoin('grupostratamientos', 'grupostratamientos.id', '=', 'grupostratamientos_id')
					->select('tratamientos.precio_base','tratamientos.codigo', 'tratamientos.nombre as nombre_trat', 'companias.nombre as nombre_comp', 'precio', 'tratamientos.id', 'grupostratamientos.nombre')
					->groupBy('nombre_comp')->orderBy('tratamientos.nombre')
					->where('tratamientos.activo', '=', '1')->get();
		/*$tcp_contenidos = Precios::leftJoin('tratamientos', 'tratamientos.id', '=', 'tratamientos_id')
			->leftJoin('companias', 'companias.id','=','companias_id')
			->leftJoin('grupostratamientos', 'grupostratamientos.id', '=', 'grupostratamientos_id')
			->select('tratamientos.precio_base','tratamientos.codigo', 'tratamientos.nombre as nombre_trat', 'companias.nombre as nombre_comp', 'precio', 'tratamientos.id', 'grupostratamientos.nombre')
			->get();
		$tcp_contenido = 	Tratamientos::raw('SELECT t.codigo, t.nombre AS nombre_trat,t.precio_base, c.nombre as nombre_comp, GROUP_CONCAT(p.precio) FROM tratamientos t
							LEFT JOIN precios p ON p.tratamientos_id = t.id
							LEFT JOIN companias c on c.id = p.companias_id
							GROUP BY t.nombre
							ORDER BY t.nombre')->get();*/
		$tcp_contenido = Tratamientos::leftJoin('precios', 'precios.tratamientos_id','=','tratamientos.id')->leftJoin('companias','companias.id','=', 'precios.companias_id')
							->select('tratamientos.id','tratamientos.codigo', 'tratamientos.nombre as nombre_trat', 'tratamientos.precio_base','companias.nombre as nombre_comp',DB::raw('GROUP_CONCAT(precios.precio) as precios'))
							->groupBy('tratamientos.nombre')->orderBy('tratamientos.nombre')->where('tratamientos.activo', '=', '1')->get();

		//print_r($tcp_contenido);
		return View::make('tratamientos.index')->with(array('tcp_cabecera' => $tcp_cabecera))->with(array('tcp_contenido' => $tcp_contenido));
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
		$crear_t = Tratamientos::create(Input::all());
                $last_id = DB::getPdo()->lastInsertId();
                $companias = Companias::lists('id');
                $tratamiento = new Tratamientos;
               foreach($companias as $compania){
                     $tratamiento->companias()->attach(array('precio' => '0.00' , 'companias_id'=>$compania, 'tratamientos_id'=>$last_id));
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
                $grupos = Grupos::lists('nombre','id');
		$precios = Precios::leftJoin('tratamientos', 'tratamientos.id', '=', 'tratamientos_id')
			->leftJoin('companias', 'companias.id','=','companias_id')
			->select('companias.nombre as nombre_comp', 'companias.id', 'precio')
			->where('tratamientos.id' , $tratamiento->id)
			->get();
		return View::make('tratamientos.editar')->with('tratamiento', $tratamiento)->with('tcp' , $precios)->with('grupos', $grupos);
	}

	public function editar_t($id){
                $i = 0;
                for($i;$i<=0;$i++){
                $input = Input::get('precio-'.$i);
                //unset($input['_token']);    
		//$guardar_t = Tratamientos::firstOrCreate($input);
                var_dump($input);}
		//  $nombre = $guardar_t;


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
