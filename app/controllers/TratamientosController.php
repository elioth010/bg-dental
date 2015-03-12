<?php

class TratamientosController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$companias = Companias::lists('nombre', 'id');

		$tratamientos = Tratamientos::where('tratamientos.activo', '=', '1')
							->leftJoin('precios', 'precios.tratamientos_id','=','tratamientos.id')
							->select('tratamientos.id','tratamientos.codigo', 'tratamientos.nombre',DB::raw('GROUP_CONCAT(precios.precio) as precios'))
							->groupBy('tratamientos.id')
							->orderBy('precios.companias_id')
							->get();

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
		$tipos_tratamientos = TiposTratamientos::lists('tipo', 'id');
		$companias = Companias::get();

		return View::make('tratamientos.crear')->with(array('grupos' => $grupos,
															'tipostratamientos' => $tipos_tratamientos,
															'companias' => $companias));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$tratamiento = new Tratamientos;
        $tratamiento->nombre 				= Input::get('nombre');
        $tratamiento->codigo 				= Input::get('codigo');
        $tratamiento->grupostratamientos_id = Input::get('grupostratamientos_id');
        $tratamiento->tipostratamientos_id 	= Input::get('tipostratamientos_id');
        $tratamiento->activo 				= Input::get('activo');
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
			$tcp = DB::table('precios')->leftJoin('tratamientos', 'tratamientos.id', '=', 'tratamientos_id')
				->leftJoin('companias', 'companias.id','=','companias_id')
				->select('tratamientos.nombre as nombre_trat', 'companias.nombre as nombre_comp', 'precio', 'tratamientos.id')
				->where('tratamientos.id' , $tratamiento->id)
				->get();

		} else {
			return Redirect::action('TratamientosController@busqueda');
		}

		return View::make('tratamientos.vertratamiento')->with(array('tratamientos' => $tratamientos, 'tcp' => $tcp));
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

		$precios = DB::table('precios')->leftJoin('tratamientos', 'tratamientos.id', '=', 'tratamientos_id')
			->leftJoin('companias', 'companias.id','=','companias_id')
			->select('companias.nombre as nombre_comp', 'companias.id', 'precio', 'grupostratamientos_id', 'tipostratamientos_id')
			->where('tratamientos.id' , $tratamiento->id)
			->get();

        $companias = Companias::lists('nombre', 'id');
        $tipos = DB::table('tipostratamientos')->get();

		return View::make('tratamientos.editar')->with(array('tratamiento' => $tratamiento, 'precios' => $precios,
															 'grupos' => $grupos, 'tipos' => $tipos,
															 'companias' => $companias));
	}

	public function guardar_t($id){
		//$codigo = Input::get('codigo');

		$tratamiento = Tratamientos::find($id);
		$tratamiento->grupostratamientos_id = Input::get('grupostratamientos_id');
		$tratamiento->tipostratamientos_id 	= Input::get('tipotratamiento');
		$tratamiento->save();

		$num_companias = Companias::count();
		$i = 1;
		while($i <= $num_companias){
			if(Input::has('precio-'.$i)){
				$compania= Input::get('cid-'.$i);
				$precio = Input::get('precio-'.$i);
				$tratamiento->companias()->detach($compania);
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
