<?php

class OpcionesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$opciones = Opciones::get();
                return View::make('opciones.index')->with('opciones', $opciones);
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
		Opciones::create(Input::all());
                return Redirect::action('OpcionesController@index')->with('message', 'Opción guardada');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		echo "show";
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		
                $opcion = Opciones::find($id);
                
                return View::make('opciones.edit')->with('opcion', $opcion);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
            
                $opcion = Opciones::find($id);
                $opcion->nombre = Input::get('nombre');
                $opcion->valor = Input::get('valor');
                $opcion->oculto = Input::get('oculto', 0);
                $opcion->desc = Input::get('desc');
                $opcion->update();
                return Redirect::action('OpcionesController@index')->with('message', 'Opción actualizada');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
            $opcion = Opciones::find($id);
            $opcion->delete();
            return Redirect::action('OpcionesController@index')->with('message', 'Opción eliminada');
	}


}
