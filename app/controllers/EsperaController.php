<?php

class EsperaController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Redirect::action('PacientesController@index');
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
        $paciente_id = Input::get('paciente_id');
        $espera = Espera::where(array('paciente_id' => $paciente_id, 'admitido' => 1))->get();
        if ($espera->isEmpty()) {
            $espera = new Espera;
            $espera->paciente_id = $paciente_id;
            $espera->admitido = 1;
            $espera->profesional_id = Input::get('profesional_id');
            $espera->save();
            return Redirect::action('PacientesController@index')->with('message', 'Paciente admitido.');
        } else {
            return Redirect::action('PacientesController@index')->with('message', 'El paciente ya está en espera.');
        }

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
        echo "HOLA";
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $espera = Espera::where('id', $id)->firstOrFail();
        $dt = new DateTime;
        $espera->update(array('admitido' => 0, 'end_date' => $dt->format('y-m-d H:i:s')));

        return Redirect::action('Historial_clinicoController@index')->with('message', 'Paciente eliminado de la lista de espera.');
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
