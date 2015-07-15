<?php

class PacientesController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $pacientes = Espera::where('espera.admitido', 1)
                            ->select('espera.id', 'espera.paciente_id', 'espera.begin_date', 'espera.end_date', 'espera.profesional_id', 'espera.admitido',
                                     'pacientes.numerohistoria', 'pacientes.nombre', 'pacientes.apellido1', 'pacientes.apellido2',
                                      'profesionales.nombre as p_n', 'profesionales.apellido1 as p_a1', 'profesionales.apellido2 as p_a2')
                            ->leftJoin('pacientes', 'espera.paciente_id', '=', 'pacientes.id')
                            ->leftJoin('profesionales', 'espera.profesional_id', '=', 'profesionales.id')
                            ->orderBy('espera.begin_date')
                            ->get();

        //$esperas = Espera::where('admitido', 1)->lists('admitido', 'paciente_id');
        $profesionales = Profesional::orderBy('nombre')->select(DB::raw("CONCAT_WS(' ', nombre, apellido1, apellido2) AS nombre"), 'id')->lists('nombre', 'id');

        return View::make('pacientes.index')->with(array('profesionales' => $profesionales, 'pacientes' => $pacientes));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $companias = Companias::orderBy('nombre')->lists('nombre', 'id');
        return View::make('pacientes.crear')->with(array('companias' => $companias));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $validator = Validator::make(Input::all(), Pacientes::$p_rules);

        if ($validator->passes()) {
            if(Input::get('fecha_nac'))
	{
	    $fecha_nac = explode('/', Input::get('fecha_nac'));
            $fecha_nac = $fecha_nac[2]."-".$fecha_nac[1]."-".$fecha_nac[0];
	    $nuevo_paciente->fechanacimiento = $fecha_nac;

	}
            $nuevo_paciente = new Pacientes(Input::all());
            $nuevo_paciente->saldo = 0;
            $nuevo_paciente->save();

            return Redirect::action('PacientesController@index')->with('message', 'Paciente creado con éxito.');
        } else {
            return Redirect::action('PacientesController@create')->with('message', 'Existen los siguientes errores:')
                                                                 ->withErrors($validator)->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */

     public function busqueda()
     {
        $query = Input::get('q', '');

        if ($query != '') {
            $busca = '%'.$query.'%';
            $pacientes = Pacientes::select('pacientes.id', 'numerohistoria', 'pacientes.nombre', 'pacientes.apellido1', 'pacientes.apellido2')
                                    ->where(DB::raw('concat(pacientes.nombre, " ", pacientes.apellido1, " ", pacientes.apellido2)'), 'LIKE', $busca)
                                    ->orWhere(DB::raw('concat(pacientes.apellido1, " ", pacientes.apellido2, " ", pacientes.nombre)'), 'LIKE', $busca)
                                    ->orWhere('numerohistoria', 'LIKE', $busca)
                                    ->get();
            $espera = Espera::where('admitido', 1)->leftJoin('profesionales', 'espera.profesional_id', '=', 'profesionales.id')->select('paciente_id', 'profesionales.*')
                    ->where('profesionales.activo', 1)->get();

            foreach($pacientes as $paciente)
            {
                if(isset($espera[$paciente->id]))
                {
                    $paciente->admitido = 1;
                    $paciente->prof_asignado = $espera[$paciente->id]->nombre.', '.$espera[$paciente->id]->apellido1.' '.$espera[$paciente->id]->apellido2;
                }
            }
            $profesionales = Profesional::orderBy('nombre')->select(DB::raw("CONCAT_WS(' ', nombre, apellido1, apellido2) AS nombre"), 'id')->lists('nombre', 'id');

        } else {
            return Redirect::action('PacientesController@buscar');
        }

        return View::make('pacientes.busqueda')->with(array('profesionales' => $profesionales, 'pacientes' => $pacientes,
                                                            'espera' => $espera, 'busca' => $query));
     }


    public function buscar() {
        return View::make('pacientes.buscar');
    }

    public function show($id)
    {
        $paciente = Pacientes::where('pacientes.id', $id)
                        ->leftJoin('companias as c1t', 'c1t.id', '=', 'pacientes.compania')
                        ->leftJoin('companias as c2t', 'c2t.id', '=', 'pacientes.compania2')
                        ->select('pacientes.*', 'c1t.nombre as c1', 'c2t.nombre as c2')
                        ->firstOrFail();
        if($paciente->c2 == 0)
        {
            $paciente->c2 = "Este paciente no tiene ninguna compañía opcional.";
        }
        //asort($companias);
        return View::make('pacientes.show')->with(array('paciente' => $paciente));
    }

    public function edit($id)
    {
        $paciente = Pacientes::where('id', $id)->firstOrFail();
        $companias = Companias::lists('nombre', 'id');
        asort($companias);
        return View::make('pacientes.edit')->with(array('paciente' => $paciente, 'companias' => $companias));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $paciente = Pacientes::find($id);
        $paciente->update(Input::all());
        return Redirect::action('PacientesController@index')->with('message', 'Paciente modificado con éxito.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
//    public function update($id)
//    {
//        //
//    }


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
