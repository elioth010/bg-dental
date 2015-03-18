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
							->select('tratamientos.id','tratamientos.codigo', 'tratamientos.nombre',DB::raw('GROUP_CONCAT(IFNULL(precios.precio, "NULL")) as precios'))
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
        $tratamiento->tipostratamientos_id 	= Input::get('tipotratamiento');
        $tratamiento->activo 				= Input::get('activo', 1);
        $tratamiento->save();

        $num_companias = Companias::count();
        $i = 1;
        while($i <= $num_companias){
            if(Input::has('cid-'.$i)){
	            $compania = Input::get('cid-'.$i);
	            $precio = Input::get('precio-'.$i);
				if ($precio == '') $precio = NULL;

				$pt = array('precio' => $precio);
	            $tratamiento->precios()->attach($compania, $pt);
            }
			$i++;
		}

		return Redirect::action('TratamientosController@index');
		//return Redirect::action('TratamientosController@edit', $tratamiento->id);
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

			$companias = Companias::lists('nombre', 'id');

			$tratamientos = Tratamientos::where('nombre','LIKE', $nombre)->orWhere('codigo','LIKE', $codigo)
								->leftJoin('precios', 'precios.tratamientos_id','=','tratamientos.id')
								->select('tratamientos.id','tratamientos.codigo', 'tratamientos.nombre',DB::raw('GROUP_CONCAT(IFNULL(precios.precio, "NULL")) as precios'))
								->groupBy('tratamientos.id')
								->orderBy('precios.companias_id')
								->get();

		} else {
			return Redirect::action('TratamientosController@busqueda');
		}

		return View::make('tratamientos.busqueda')->with(array('tratamientos' => $tratamientos, 'companias' => $companias));
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
		$companias = Companias::lists('nombre', 'id');
		$tipos = TiposTratamientos::get();

		$precios = Precios::leftJoin('tratamientos', 'tratamientos.id', '=', 'tratamientos_id')
			->leftJoin('companias', 'companias.id','=','companias_id')
			->select('companias.nombre as nombre_comp', 'companias.id as cid', 'precio', 'grupostratamientos_id', 'tipostratamientos_id')
			->where('tratamientos.id' , $id)
			->get();

		foreach($precios as $p) {
			$p->disabled = is_null($p->precio) ? TRUE: FALSE;
		}

		return View::make('tratamientos.editar')->with(array('tratamiento' => $tratamiento, 'precios' => $precios,
															 'grupos' => $grupos, 'tipos' => $tipos,
															 'companias' => $companias));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$tratamiento = Tratamientos::find($id);
		$tratamiento->nombre                = Input::get('nombre');
        $tratamiento->codigo 				= Input::get('codigo');
		$tratamiento->grupostratamientos_id = Input::get('grupostratamientos_id');
		$tratamiento->tipostratamientos_id 	= Input::get('tipotratamiento');
        $tratamiento->activo 				= Input::get('activo', 1);
		$tratamiento->save();

		$tratamiento->precios()->detach();

		$num_companias = Companias::count();
		$i = 1;
		while($i <= $num_companias){
			echo $i;
			if (Input::has('cid-'.$i)) {
				echo $i;
				$compania = Input::get('cid-'.$i);
				$precio = Input::get('precio-'.$i);

				$activado = Input::get('activado-'.$i);
				if ($precio == '' || !$activado) $precio = NULL;

				$pt = array('precio' => $precio);
				$tratamiento->precios()->attach($compania, $pt);

			}
			$i++;
		}

		//return Redirect::to('tratamientos');
		return Redirect::action('TratamientosController@edit', $tratamiento->id);
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
