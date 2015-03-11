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
					->select('tratamientos.codigo', 'tratamientos.nombre as nombre_trat', 'companias.nombre as nombre_comp', 'precio', 'tratamientos.id', 'grupostratamientos.nombre')
					->groupBy('nombre_comp')->orderBy('tratamientos.grupostratamientos_id')
					->where('tratamientos.activo', '=', '1')->get();
		$tcp_contenido = Tratamientos::leftJoin('precios', 'precios.tratamientos_id','=','tratamientos.id')->leftJoin('companias','companias.id','=', 'precios.companias_id')
							->select('tratamientos.id','tratamientos.codigo', 'tratamientos.nombre as nombre_trat','companias.nombre as nombre_comp',DB::raw('GROUP_CONCAT(precios.precio) as precios'))
							->groupBy('tratamientos.id')->orderBy('companias.id')->where('tratamientos.activo', '=', '1')->get();
                
		
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
                $tipos_tratamientos = TiposTratamientos::lists('tipo', 'id');
                $companias = Companias::get();
		return View::make('tratamientos.crear')
                        ->with(array('grupos' => $grupos))
                        ->with(array('tipostratamientos' => $tipos_tratamientos))
                        ->with(array('companias' => $companias));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
            $tratamiento = new Tratamientos;
            $codigo = Input::get('codigo');
            $nombre = Input::get('nombre');
            $grupo = Input::get('grupostratamientos_id');
            $tipo = Input::get('tipostratamientos_id');
            $activo = Input::get('activo');
            $last_id = DB::getPdo()->lastInsertId();
            $companias = Companias::lists('id');
            $tratamiento->nombre = $nombre;
            $tratamiento->codigo = $codigo;
            $tratamiento->grupostratamientos_id= $grupo;
            $tratamiento->tipostratamientos_id = $tipo;
            $tratamiento->activo=$activo;
            $tratamiento->save();
            $num_companias = Companias::count();
            $i = 1;
            while($i <= $num_companias){
            if(Input::has('id-'.$i)){
            $compania= Input::get('id-'.$i);
            $precio = Input::get('precio-'.$i);
            $tratamiento->companias()->attach($compania, array('precio' => $precio));
            }
            $i++;
           }
            //return Redirect::to('tratamientos');
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
                $companias = Companias::get();
		$precios = Precios::leftJoin('tratamientos', 'tratamientos.id', '=', 'tratamientos_id')
			->leftJoin('companias', 'companias.id','=','companias_id')
			->select('companias.nombre as nombre_comp', 'companias.id', 'precio', 'grupostratamientos_id', 'tipostratamientos_id')
			->where('tratamientos.id' , $tratamiento->id)
			->get();
                $companias = Companias::lists('nombre', 'id');
                var_dump($companias);
                $tipos = DB::table('tipostratamientos')->get();
		return View::make('tratamientos.editar')->with('tratamiento', $tratamiento)->with('tcp' , $precios)->with('grupos', $grupos)->with('tipos', $tipos)->with('companias', $companias);
	}

	public function guardar_t($id){
                $codigo = Input::get('codigo');
                $grupostratamientos_id = Input::get('grupostratamientos_id');
                $tipostratamientos_id = Input::get('tipotratamiento');
                $tratamiento = Tratamientos::find($id);
                $tratamiento->grupostratamientos_id = $grupostratamientos_id;
                $tratamiento->tipostratamientos_id = $tipostratamientos_id;
                $tratamiento->save();
                $num_companias = Companias::count();
                $i = 1;
                while($i <= $num_companias){
                if(Input::has('precio-'.$i)){
                $compania= Input::get('cid-'.$i);
                $precio = Input::get('precio-'.$i);
                $tratamiento->companias($compania)->detach($compania);
                $tratamiento->companias()->attach($compania, array('precio' => $precio));
                }
                $i++;
               }
                
                //$tratamientoaguardado = Tratamientos::where('id',$id)->first();
                //return Redirect::to('tratamientos');
                
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
