<?php

class CobrosController extends \BaseController {

	/**
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

        $cobros = Cobros::where('cobros.created_at', '>=', $fecha_inicio_iso)
                    ->where(DB::raw('CAST(cobros.created_at as DATE)'),  '<=', $fecha_fin_iso)
                    ->leftJoin('tipos_de_cobro', 'tipos_de_cobro.id', '=', 'cobros.tipos_de_cobro_id')
                    ->leftJoin('pacientes', 'pacientes.id', '=', 'cobros.paciente_id')
                    ->select('cobros.*', 'tipos_de_cobro.nombre as tc_n', 'pacientes.nombre as p_n', 'pacientes.apellido1 as p_a1', 'pacientes.apellido2 as p_a2', DB::raw("DATE_FORMAT(cobros.created_at, '%d/%m/%Y') as creado"))
                    ->get();
        return View::make('cobros.index')->with('cobros', $cobros)->with('fecha_inicio', $fecha_inicio)->with('fecha_fin', $fecha_fin);

	}


    public function morosos()
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

        $p_d_c = Historial_clinico::whereBetween('fecha_realizacion', array($fecha_inicio, $fecha_fin))->where('pendiente_de_cobro', 1)
                ->leftJoin('pacientes', 'historial_clinico.paciente_id', '=', 'pacientes.id')
                ->select('historial_clinico.*', 'pacientes.nombre as p_n', 'pacientes.apellido1 as p_a1', 'pacientes.apellido2 as p_a2',
                        DB::raw("DATE_FORMAT(historial_clinico.fecha_realizacion, '%d/%m/%Y') as fecha"))
                ->get();
        foreach ($p_d_c as $h)
        {
            $cobros_a_restar_de_precio = Cobros::where('historial_clinico_id', $h->id)->sum('cobro'); //Esto es la suma de los cobros de un item de HC
            $h->pdc = $h->precio - $cobros_a_restar_de_precio;
        }
        return View::make ('estadisticas.morosos')->with('p_d_c' , $p_d_c)->with('fecha_inicio', $fecha_inicio)->with('fecha_fin', $fecha_fin);
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

	public function anticipo()
	{
		$cobro = new Cobros;
        $cobro->paciente_id = Input::get('paciente_id');
        $cobro->cobro = Input::get('anticipar');
        $cobro->tipos_de_cobro_id = Input::get('tipos_de_cobro_id');
        $cobro->save();

        return Redirect::action('Historial_clinicoController@show', Input::get('paciente_id'));
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$cobro = new Cobros;
        $cobro->paciente_id = Input::get('paciente_id');
        $cobro->cobro = Input::get('cobrar');
        $cobro->tipos_de_cobro_id = Input::get('tipos_de_cobro_id');
        $cobro->historial_clinico_id = Input::get('historial_clinico_id');
        $cobro->save();

        $historial = Historial_clinico::where('id', Input::get('historial_clinico_id'))->firstOrFail();
        $cobros = Cobros::where('historial_clinico_id', $historial->id)->sum('cobro');
        $pdc = $historial->precio - $cobros;
        if($pdc == 0)
        {
            $historial->pendiente_de_cobro = 0;
            $historial->update();
        }

//                if($historial->precio - Input::get('cobrar') != 0)
//                    {
//
//                        if(Input::get('tipos_de_cobro_id') == 1)
//                        {
//                            $paciente = Pacientes::where('id', Input::get('paciente_id'))->firstOrFail();
//                            $paciente->saldo = $paciente->saldo - Input::get('cobrar');
//                            $paciente->update();
//                        }
//                            $historial->pendiente_de_cobro = 1;
//                            $historial->cobrado_paciente = $historial->cobrado_paciente + Input::get('cobrar');
//                            $historial->update();
//
//
//                    } else {
//                            $historial->pendiente_de_cobro = 0;
//                            $historial->cobrado_paciente = Input::get('cobrar');
//                            $historial->update();
//                    }
//                $historial->pendiente_de_cobro = 0;
//                $historial->update();
//
//                $paciente = Pacientes::where('id', Input::get('paciente_id'))->firstOrFail();
//                if(Input::get('tipos_de_cobro_id') == 1){
//                    $paciente->saldo = $paciente->saldo - Input::get('cobrar');
//                    $paciente->update();
//                }



        return Redirect::action('Historial_clinicoController@show', Input::get('paciente_id'));
        //echo "H";
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$fecha_fin = date('d/m/Y');
        $fecha_primeros = date('/m/Y');
        $fecha_inicio = "1".$fecha_primeros;

        $cobros = Cobros::where('cobros.paciente_id', $id)
             ->leftJoin('tipos_de_cobro', 'tipos_de_cobro.id', '=', 'cobros.tipos_de_cobro_id')
            ->leftJoin('pacientes', 'pacientes.id', '=', 'cobros.paciente_id')
            ->select('cobros.*', 'tipos_de_cobro.nombre as tc_n', 'pacientes.nombre as p_n')
            ->get();
        return View::make('cobros.index')->with('cobros', $cobros)->with('fecha_inicio', $fecha_inicio)->with('fecha_fin', $fecha_fin);
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
