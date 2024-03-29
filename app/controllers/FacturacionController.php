<?php

class FacturacionController extends \BaseController {

    /**index
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (Input::has('fecha_inicio') && Input::get('fecha_fin')){
            $fecha_inicio = Input::get('fecha_inicio');
            $fecha_fin = Input::get('fecha_fin');
        } else {
            $fecha_fin = date('d/m/Y');
            $fecha_primeros = date('/m/Y');
            $fecha_inicio = "1".$fecha_primeros;
        }

        $fecha_inicio_iso = explode('/', $fecha_inicio);
        $fecha_inicio_iso = $fecha_inicio_iso[2]."-".$fecha_inicio_iso[1]."-".$fecha_inicio_iso[0];
        $fecha_fin_iso = explode('/', $fecha_fin);
        $fecha_fin_iso = $fecha_fin_iso[2]."-".$fecha_fin_iso[1]."-".$fecha_fin_iso[0];

        $profesional = Profesional::where('user_id', Auth::user()->id )->first();
        if(count($profesional) > 0)
        {
            $historiales = Historial_clinico::whereBetween('fecha_realizacion', array($fecha_inicio_iso, $fecha_fin_iso))
                    ->leftJoin('pacientes', 'historial_clinico.paciente_id', '=', 'pacientes.id')
                    ->select('pacientes.nombre as p_n', 'pacientes.apellido1 as p_a1', 'pacientes.apellido2 as p_a2', 'pacientes.id as p_id',
                            'tratamientos.nombre as t_n',
                            DB::raw("DATE_FORMAT(fecha_realizacion, '%d/%m/%Y') as fecha"),
                            'abonado_quiron',
                            'cobrado_profesional', 'historial_clinico.id as h_id', 'historial_clinico.*')
                    ->leftJoin('tratamientos', 'historial_clinico.tratamiento_id', '=', 'tratamientos.id')
                    ->where('profesional_id', $profesional->id)
                    ->orderBy('fecha_realizacion', 'ASC')->get();
            //var_dump($historial);
            return View::make('facturacion.index')->with('historiales', $historiales)->with('fecha_inicio', $fecha_inicio)->with('fecha_fin', $fecha_fin);
        } else {
            return Redirect::action('ProfesionalController@index')->with('message', 'No existe ningún profesional asignado a su usuario. Asigne ahora uno, o dirígase a los administradores de la aplicación');
        }
    }

    public function index_nc() //Index de facturación (u historiales) con fechas del formulario q están sin cobrar
    {
        $fecha_inicio = Input::get('fecha_inicio');
        $fecha_inicio_iso = explode('/', $fecha_inicio);
        $fecha_inicio_iso = $fecha_inicio_iso[2]."-".$fecha_inicio_iso[1]."-".$fecha_inicio_iso[0];
        $fecha_fin = Input::get('fecha_fin');
        $fecha_fin_iso = explode('/', $fecha_fin);
        $fecha_fin_iso = $fecha_fin_iso[2]."-".$fecha_fin_iso[1]."-".$fecha_fin_iso[0];

        $historiales = Historial_clinico::whereBetween('fecha_realizacion', array($fecha_inicio_iso, $fecha_fin))
                ->where('cobrado_profesional', 0)
                ->leftJoin('pacientes', 'historial_clinico.paciente_id', '=', 'pacientes.id')
                ->select('pacientes.nombre as p_n', 'pacientes.apellido1 as p_a1', 'pacientes.apellido2 as p_a2', 'pacientes.id as p_id',
                        'tratamientos.nombre as t_n',
                        'fecha_realizacion',
                        'abonado_quiron',
                        'cobrado_profesional', 'historial_clinico.id as h_id', 'historial_clinico.*')
                ->leftJoin('tratamientos', 'historial_clinico.tratamiento_id', '=', 'tratamientos.id')
                ->orderBy('fecha_realizacion', 'DESC')->get();
        //var_dump($historial);
        return View::make('facturacion.index')->with('historiales', $historiales)->with('fecha_inicio', $fecha_inicio)->with('fecha_fin', $fecha_fin);
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
        //
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
        //var_dump($_POST);
        $input = Input::except('_token');
        $i = 1;
        foreach ($input as $key => $value) {
            $historial = Historial_clinico::find($id);
            $historial->abonado_quiron = Input::get('abonado_quiron-'.$i, 0);
            $historial->cobrado_profesional = Input::get('cobrado_profesional-'.$i, 0);
            $historial->coste_lab = Input::get('coste_lab-'.$i, 0);
            $historial->update();
            $i++;
        }
        echo "HOLA";
        //return Redirect::action('FacturacionController@index')->with('message', 'Facturación modificada con éxito.');
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
