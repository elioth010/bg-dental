<?php

class GruposController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $grupos = Grupos::all();
        return View::make('tratamientos.grupos', array('grupos' => $grupos));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $grupos = Grupos::all();
        return View::make('tratamientos.grupos')->with('grupos',$grupos);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        Grupos::create(Input::all());
        echo "Grupo guardado";
        return Redirect::action('GruposController@index');
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
        $grupo = Grupos::find($id);
        return View::make('tratamientos.editargrupos')->with('grupo', $grupo);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $grupo = Grupos::find($id);
        $grupo->update(Input::all());
        return Redirect::action('GruposController@index')->with('message', 'Grupo actualizado');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Grupos::destroy($id);
        return Redirect::action('GruposController@index')->with('message', 'Grupo eliminado');
    }


}
