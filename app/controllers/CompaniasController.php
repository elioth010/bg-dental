<?php

class CompaniasController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$companias = Companias::all();
		return View::make('tratamientos.companias', array('companias' => $companias));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$companias = Companias::all();
		return View::make('tratamientos.companias')->with('companias',$companias);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), Companias::$p_rules);

        if ($validator->passes()) {

			$compania = Companias::create(Input::all());
			echo "Compañía guardada";
			$tratamientos = Tratamientos::all();
			foreach ($tratamientos as $tratamiento) {
				$tratamiento->precios()->attach($compania->id, array('precio' => NULL));
			}
		} else {
            return Redirect::action('CompaniasController@create')->with('message', 'Existen los siguientes errores:')->withErrors($validator->messages())->withInput();
        }

		return Redirect::to('tratamientos/crearcompania');
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
