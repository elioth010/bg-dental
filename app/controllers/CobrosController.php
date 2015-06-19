<?php

class CobrosController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            
            
            
            
            
            
            $cobros = Cobros::leftJoin('tipos_de_cobro', 'tipos_de_cobro.id', '=', 'cobros.tipos_de_cobro_id')
                        ->leftJoin('pacientes', 'pacientes.id', '=', 'cobros.paciente_id')
                        ->select('cobros.*', 'tipos_de_cobro.nombre as tc_n', 'pacientes.nombre as p_n')
                        ->get();
            return View::make('cobros.index')->with('cobros', $cobros);
            
	}
        
        public function index_cf()
	{
            if (!empty($_POST)){
                $fecha_inicio = Input::get('fecha_inicio');
                $fecha_inicio = explode('/', $fecha_inicio);
                $fecha_inicio = $fecha_inicio[2]."-".$fecha_inicio[1]."-".$fecha_inicio[0];
                $fecha_fin = Input::get('fecha_fin');
                $fecha_fin = explode('/', $fecha_fin);
                $fecha_fin = $fecha_fin[2]."-".$fecha_fin[1]."-".$fecha_fin[0];
//                var_dump($fecha_fin);
//                var_dump($fecha_inicio);
                //echo "POST";
            } else {
                $fecha_fin = date('Y-m-d');
                $fecha_primeros = date('Y-m-');
                $fecha_inicio = $fecha_primeros."1";
//                var_dump($fecha_fin);
//                var_dump($fecha_inicio);
//                echo "Sin POST";
            }
            
            
            
            
            
            $cobros = Cobros::whereBetween('cobros.created_at', array($fecha_inicio, $fecha_fin))->leftJoin('tipos_de_cobro', 'tipos_de_cobro.id', '=', 'cobros.tipos_de_cobro_id')
                        ->leftJoin('pacientes', 'pacientes.id', '=', 'cobros.paciente_id')
                        ->select('cobros.*', 'tipos_de_cobro.nombre as tc_n', 'pacientes.nombre as p_n')
                        ->get();
            return View::make('cobros.index')->with('cobros', $cobros);
            
	}

        public function morosos()
	{
            $p_d_c = Historial_clinico::where('pendiente_de_cobro', 1)->get();
            return View::make ('estadisticas.morosos')->with('p_d_c' , $p_d_c);
                    
            
	}
        
        public function morosos_cf()
	{
            $fecha_inicio = Input::get('fecha_inicio');
            $fecha_inicio = explode('/', $fecha_inicio);
            $fecha_inicio = $fecha_inicio[2]."-".$fecha_inicio[1]."-".$fecha_inicio[0];
            $fecha_fin = Input::get('fecha_fin');
            $fecha_fin = explode('/', $fecha_fin);
            $fecha_fin = $fecha_fin[2]."-".$fecha_fin[1]."-".$fecha_fin[0];
            $p_d_c = Historial_clinico::whereBetween('fecha_realizacion', array($fecha_inicio, $fecha_fin))->where('pendiente_de_cobro', 1)->get();
            return View::make ('estadisticas.morosos')->with('p_d_c' , $p_d_c);
                    
            
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
                $paciente = Pacientes::where('id', Input::get('paciente_id'))->firstOrFail();
                
                    $paciente->saldo = $paciente->saldo + Input::get('anticipar');
                    $paciente->update();
                
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
                var_dump($historial);
                $historial->pendiente_de_cobro = 0;
                $historial->update();
                
                $paciente = Pacientes::where('id', Input::get('paciente_id'))->firstOrFail();
                if(Input::get('tipos_de_cobro_id') == 1){
                    $paciente->saldo = $paciente->saldo - Input::get('cobrar');
                    $paciente->update();
                }
                
                
                
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
            $cobros = Cobros::where('cobros.paciente_id', $id)
                 ->leftJoin('tipos_de_cobro', 'tipos_de_cobro.id', '=', 'cobros.tipos_de_cobro_id')
                ->leftJoin('pacientes', 'pacientes.id', '=', 'cobros.paciente_id')
                ->select('cobros.*', 'tipos_de_cobro.nombre as tc_n', 'pacientes.nombre as p_n')
                ->get();
            return View::make('cobros.index')->with('cobros', $cobros);
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
