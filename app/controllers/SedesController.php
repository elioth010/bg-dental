<?php

class SedesController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $sedes = Sedes::all();
        return Redirect::action('SedesController@create');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $sedes = Sedes::all();
        return View::make('sedes.sedes', array('sedes' => $sedes));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        Sedes::create(Input::all());
        return Redirect::action('SedesController@index')->with('message', 'Sede guardada');
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
    public function edit($id) {
        $sede = Sedes::find($id);
        return View::make('sedes.editar')->with('sede', $sede);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $sede = Sedes::find($id);
        $sede->update(Input::all());
        return Redirect::action('SedesController@index')->with('message', 'Sede modificada con éxito.');
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
