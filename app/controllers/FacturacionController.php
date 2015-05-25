<?php

class FacturacionController extends \BaseController {

	/**index
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            if (!empty($_POST)){
                $fecha_inicio = Input::get('fecha_inicio');
                $fecha_fin = Input::get('fecha_fin');
                var_dump($fecha_fin);
                var_dump($fecha_inicio);
                echo "POST";
            } else {
                $fecha_fin = date('Y-m-d');
                $fecha_primeros = date('Y-m-');
                $fecha_inicio = $fecha_primeros."1";
                var_dump($fecha_fin);
                var_dump($fecha_inicio);
                echo "Sin POST";
            }
            
            
//            var_dump($fecha_actual);
//            var_dump($primeros_de_mes);
            $historiales = Historial_clinico::whereBetween('fecha_realizacion', array($fecha_inicio, $fecha_fin))
                    ->leftJoin('pacientes', 'historial_clinico.paciente_id', '=', 'pacientes.id')
                    ->select('pacientes.nombre as p_n', 'pacientes.apellido1 as p_a1', 'pacientes.apellido2 as p_a2', 'pacientes.id as p_id',
                            'tratamientos.nombre as t_n',
                            'fecha_realizacion',
                            'abonado_quiron',
                            'cobrado_profesional', 'historial_clinico.id as h_id', 'historial_clinico.*')
                    ->leftJoin('tratamientos', 'historial_clinico.tratamiento_id', '=', 'tratamientos.id')
                    ->orderBy('fecha_realizacion', 'DESC')->get();
            //var_dump($historial);
            return View::make('facturacion.index')->with('historiales', $historiales);
	}
        public function index_cf() //Index de facturación (u historiales) con fechas del formulario
	{  
            $fecha_inicio = Input::get('fecha_inicio');
            $fecha_fin = Input::get('fecha_fin');
            var_dump($fecha_fin);
            var_dump($fecha_inicio);
            $historiales = Historial_clinico::whereBetween('fecha_realizacion', array($fecha_inicio, $fecha_fin))
                    ->leftJoin('pacientes', 'historial_clinico.paciente_id', '=', 'pacientes.id')
                    ->select('pacientes.nombre as p_n', 'pacientes.apellido1 as p_a1', 'pacientes.apellido2 as p_a2', 'pacientes.id as p_id',
                            'tratamientos.nombre as t_n',
                            'fecha_realizacion',
                            'abonado_quiron',
                            'cobrado_profesional', 'historial_clinico.id as h_id', 'historial_clinico.*')
                    ->leftJoin('tratamientos', 'historial_clinico.tratamiento_id', '=', 'tratamientos.id')
                    ->orderBy('fecha_realizacion', 'DESC')->get();
            //var_dump($historial);
            return View::make('facturacion.index')->with('historiales', $historiales);
	}
        public function index__nocobrado() //Index de facturación (u historiales) con fechas del formulario q están sin cobrar
	{  
            $fecha_inicio = Input::get('fecha_inicio');
            $fecha_fin = Input::get('fecha_fin');
            var_dump($fecha_fin);
            var_dump($fecha_inicio);
            $historiales = Historial_clinico::whereBetween('fecha_realizacion', array($fecha_inicio, $fecha_fin))
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
            return View::make('facturacion.index')->with('historiales', $historiales);
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
            var_dump($_POST);
//            $input = Input::except('_token');
//             foreach ($input as $key => $value) {
//            
//                $historial = Historial_clinico::find($id);
//                $historial->abonado_quiron = Input::get('abonado_quiron');
//                $historial->cobrado_profesional = Input::get('cobrado_profesional');
//                $historial->update();
//             }
//                return Redirect::to('facturacion')->with('message', 'Historial modificado con éxito.');
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
