<?php

class Historial_clinicoController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = User::where('id', Auth::id())->firstOrFail();

        $profesional = Profesional::where('user_id', $user->id)->where('activo', 1)->first();
        if(count($profesional) > 0) {
            $esperas = Espera::where('admitido', 1)->where('espera.profesional_id', $profesional->id)
                            ->leftJoin('pacientes', 'espera.paciente_id', '=', 'pacientes.id')
                            ->select('espera.id', 'espera.paciente_id', DB::raw("DATE_FORMAT(espera.begin_date, '%d/%m/%Y - %H:%i') as begin"), 'espera.end_date', 'espera.profesional_id',
                                     'pacientes.numerohistoria', 'pacientes.nombre', 'pacientes.apellido1', 'pacientes.apellido2')
                            ->orderBy('begin')
                            ->get();
            $profesionales = Profesional::select(DB::raw("CONCAT_WS(' ', nombre, apellido1, apellido2) AS nombre"), 'id')->lists('nombre', 'id');
            return View::make('historial.index')->with(array('profesionales' => $profesionales, 'esperas' => $esperas))->with('profesional', $profesional);
        } else {
            return Redirect::action('ProfesionalController@index')->with('message', 'No existe ningún profesional asignado a su usuario. Asigne ahora uno, o dirígase a los administradores de la aplicación');
        }
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
        $espera = Espera::where('profesional_id', Input::get('profesional_id'))
                        ->where('admitido', 1)->first();
        
        if(count($espera) > 0)
        {
             $presupuesto_id = Input::get('presupuesto_id', false);
        if ($presupuesto_id !== false) {
            $presupuestotratamiento_id = Input::get('presupuestotratamiento_id', 0);
            $presupuesto = Presupuestos::where('id', $presupuesto_id)->where('aceptado', 1)->firstOrFail();
            $pt = DB::table('presupuestos_tratamientos')
                         ->where('id', $presupuestotratamiento_id)
                         ->first();
            $unidades = $pt->unidades;
            $precio = $pt->precio_final;
        } else {
            $presupuestotratamiento_id = 0;
            $unidades = 1;
            $precio = Input::get('precio');
        }

        $paciente_id = Input::get('paciente_id');

        $historial = new Historial_clinico;
        $historial->tratamiento_id = Input::get('tratamiento_id');
        $historial->profesional_id = Input::get('profesional_id');
        $historial->paciente_id = $paciente_id;
        $fecha_r = Input::get('fecha_realizacion');
        $fecha_r_f = explode('/', $fecha_r);
        $historial->fecha_realizacion = $fecha_r_f[2]."-".$fecha_r_f[1]."-".$fecha_r_f[0];
        $historial->cobrado_paciente = Input::get('cobrado_paciente', 0);
        if($precio == 0)
        {
            $historial->pendiente_de_cobro = 1;
        }
        $historial->abonado_quiron = Input::get('abonado_quiron', 0);
        $historial->cobrado_profesional = Input::get('cobrado_profesional', 0);
        $historial->coste_lab = Input::get('coste_lab', 0);
        $historial->unidades = Input::get('unidades', 1);
        $historial->precio = $historial->unidades * $precio / $unidades;
        $historial->presupuesto_tratamiento_id = $presupuestotratamiento_id;
        if($historial->precio == 0) {
            $historial->pendiente_de_cobro = 0;
        }
        $historial->save();

        if ($presupuesto_id !== false) {
            $unidades_restantes = $unidades - Historial_clinico::where('presupuesto_tratamiento_id', $pt->id)->sum('unidades');
            // Marcar el tratamiento como realizado en el presupuesto si todas sus unidades se han realizado
            if ($unidades_restantes == 0) {
                $presupuesto->tratamientos2()->updateExistingPivot($historial->presupuesto_tratamiento_id, array('estado' => 1));
            }
        }

        return Redirect::action('Historial_clinicoController@show', $paciente_id);
        } else {
            return View::make('layouts.sinpermisos')->with('message', 'El paciente no se encuentra en su lista de admitidos.');
        }
       
    }

     public function store_ayudantia()
    {
            $paciente_id = Input::get('paciente_id');
            $historial = new Historial_clinico;
            $historial->tratamiento_id = Input::get('tratamiento_id');
            $historial->profesional_id = Input::get('profesional_id');
            $historial->paciente_id = $paciente_id;
            $historial->fecha_realizacion = Input::get('fecha_realizacion');
            $historial->ayudantia = 1;
            $historial->presupuesto_tratamiento_id = Input::get('presupuestotratamiento_id', 0);
            $ayudantia = Opciones::find('1');
            $ayudantia = $ayudantia->valor;
            $historial->precio = Input::get('precio') -  ((Input::get('precio') * (100 - $ayudantia)) / 100);
            if($historial->precio == 0){
                $historial->pendiente_de_cobro = 0;
            } else {
                $historial->pendiente_de_cobro = 1;
            }
            $historial->id_hist_ayudantia = Input::get('id_hist_ayudantia');
            $historial->coste_lab = Input::get('coste_lab', 0);

            $presupuesto_id = Input::get('presupuesto_id', false);
            if ($presupuesto_id) {
                // Marcar el tratamiento como realizado en el presupuesto
                $presupuesto = Presupuestos::where('id', $presupuesto_id)->where('aceptado', 1)->firstOrFail();
                $presupuesto->tratamientos2()->updateExistingPivot($historial->presupuesto_tratamiento_id, array('estado' => 1));
            }

            $historial->save();
            //Ponemos el valor de ayudantia_aplicada que es la id de la linea de historial_clinico que tiene la ayudantia
            $poner_ayudantia_aplicada = Historial_clinico::find(Input::get('id_hist_ayudantia'));
            $poner_ayudantia_aplicada->ayudantia_aplicada = $historial->id;
            $poner_ayudantia_aplicada->update();
//
//            $paciente = Pacientes::where('id', $paciente_id)->firstOrFail();
//            $paciente->saldo = $paciente->saldo - Input::get('precio');
//            $paciente->update();

            return Redirect::action('Historial_clinicoController@show', $paciente_id);
    }


    // Construye un array para javascript de crear/editar presupuesto
    private function getTratamientosArray($grupos, $companias, $companias_paciente) {

        $preciosObj = Precios::whereIn('companias_id', array_keys($companias))->get(array('tratamientos_id', 'precio', 'companias_id'));
        $precios = array();
        $companiaEconomica = array();

        // Escoge el precio más barato de las dos compañías
        foreach ($preciosObj as $p)
        {
            if (in_array($p->companias_id, $companias_paciente)) {
                if (!(array_key_exists($p->tratamientos_id, $precios)) ||
                    ((array_key_exists($p->tratamientos_id, $precios)) && ($p->precio < $precios[$p->tratamientos_id]))) {

                    $precios[$p->tratamientos_id][$p->companias_id] = $p->precio;
                }

                if (!(array_key_exists($p->tratamientos_id, $companiaEconomica)) ||
                    ((array_key_exists($p->tratamientos_id, $companiaEconomica)) && ($p->precio < $precios[$p->tratamientos_id][$companiaEconomica[$p->tratamientos_id]]))) {

                    $companiaEconomica[$p->tratamientos_id] = $p->companias_id;
                }
            }
        }

        $tratamientosAll = Tratamientos::where('historiable', 1)->get(array('nombre', 'id', 'grupostratamientos_id', 'tipostratamientos_id'));

        $atratamientos = array();
        foreach ($tratamientosAll as $t) {
            // No mostrar el tratamiento si no tiene precio asignado en las compañías del paciente
            if (array_key_exists($t->id, $precios)) {
                $ta = array('id' => $t->id, 'nombre' => $t->nombre, 'compania_economica' => $companiaEconomica[$t->id],
                            'precios' => $precios[$t->id], 'tipo' => $t->tipostratamientos_id);
                $atratamientos[$t->grupostratamientos_id][$t->id] = $ta;
            }
        }

        return $atratamientos;
    }

    /* */
    private function _data_aux_historial($paciente) {

        $companias_list = Companias::lists('nombre', 'id');
        $companias_paciente = array();
        $companias_paciente[] = $paciente->compania;

        $paciente->companias_text = $companias_list[$paciente->compania];
        if ($paciente->compania2 != 0) {
            $companias_paciente[] = $paciente->compania2;
            $paciente->companias_text .= ' y ' . $companias_list[$paciente->compania2];
        }

        $grupos = Grupos::orderBy('id')->get(array('id', 'nombre'));
        
        $anticipos = Cobros::where('paciente_id', $paciente->id)->where('historial_clinico_id', 0)->sum('cobro'); //los cobros con historial clínico = 0 son anticipos pagados desde el HC de un paciente.
        $todos_los_cobros_de_anticipo = Cobros::where('paciente_id', $paciente->id)->where('historial_clinico_id', '!=', 0)->where('tipos_de_cobro_id', 1)->sum('cobro');
        $saldo_anticipos = $anticipos - $todos_los_cobros_de_anticipo;

        $atratamientos = $this->getTratamientosArray($grupos, $companias_list, $companias_paciente);
        
        return array('grupos' => $grupos,
                    'paciente' => $paciente,
                    'atratamientos' => $atratamientos,
                    'companias' => $companias_list,
                    'saldon' => $saldo_anticipos);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $paciente = Pacientes::where('id', $id)->firstOrFail();
        
        
        $user = Auth::id();
        $profesional = Profesional::where('user_id', $user)->firstOrFail();

        $profesionales_list = array();
        foreach (Profesional::all() as $p) {
            $profesionales_list[$p->id] = $p->getFullNameAttribute();
        }

        $historiales = Historial_clinico::where('paciente_id', $paciente->id)
                ->leftJoin('tratamientos', 'historial_clinico.tratamiento_id', '=', 'tratamientos.id')
                ->leftJoin('grupostratamientos', 'tratamientos.grupostratamientos_id', '=', 'grupostratamientos.id')
                ->leftJoin('profesionales', 'historial_clinico.profesional_id', '=', 'profesionales.id' )
                ->select('historial_clinico.*',DB::raw("DATE_FORMAT(historial_clinico.fecha_realizacion, '%d/%m/%Y') as date"), 'profesionales.nombre as pr_n', 'profesionales.apellido1 as pr_a1',
                        'profesionales.apellido2 as pr_a2', 'tratamientos.nombre as t_n', 'tratamientos.id as t_id', 'grupostratamientos.nombre as t_g')
                ->orderBy('id', 'DESC')
                ->get();

        
        foreach ($historiales as $h)
        {
            $cobros_a_restar_de_precio = Cobros::where('historial_clinico_id', $h->id)->sum('cobro'); //Esto es la suma de los cobros de un item de HC
            $h->pdc = $h->precio - $cobros_a_restar_de_precio;
        }


        $anticipos = Cobros::where('paciente_id', $paciente->id)->where('historial_clinico_id', 0)->sum('cobro'); //los cobros con historial clínico = 0 son anticipos pagados desde el HC de un paciente.
        $todos_los_cobros_de_anticipo = Cobros::where('paciente_id', $paciente->id)->where('historial_clinico_id', '!=', 0)->where('tipos_de_cobro_id', 1)->sum('cobro');
        $saldo_anticipos = $anticipos - $todos_los_cobros_de_anticipo;
        $p_d_c = Historial_clinico::where('pendiente_de_cobro', 1)->where('paciente_id', $id)->get();
        $p_d_c->pendiente = 0;
        foreach($p_d_c as $p)
        {
            $cobros = Cobros::where('historial_clinico_id', $p->id)->sum('cobro');
            $p_d_c->pendiente += $p->precio - $cobros;
        }

        $presupuestos = Presupuestos::where('numerohistoria', $paciente->numerohistoria)->where('aceptado', 1)
                                    ->select('presupuestos.*', DB::raw("DATE_FORMAT(created_at, '%d/%m/%Y') as creado"))
                                    ->orderBy('created_at', 'DESC')->get();

        $hay_presupuestos = false;
        foreach ($presupuestos as $p) {
            $presu_trats = $p->tratamientos()->get(array('presupuestos_tratamientos.*', 'tratamientos.nombre'));
            $include = false;
            foreach ($presu_trats as $pt) {

                // El presupuesto se mostrará si hay algún tratamiento aún por realizar.
                if ($pt->estado == 0) {
                    $include = true;
                }
                $pt->unidades_restantes = $pt->unidades - Historial_clinico::where('presupuesto_tratamiento_id', $pt->id)->sum('unidades');
            }

            if ($include) {
                $p->presu_tratamientos = $presu_trats;
                $hay_presupuestos = true;
            } else {
                $p->presu_tratamientos = array();
            }
        }

        $data = $this->_data_aux_historial($paciente);
        $tipos_de_cobro = Tipos_de_cobro::lists('nombre', 'id');
        $tipos_de_cobro_anticipos = Tipos_de_cobro::lists('nombre', 'id');
        unset($tipos_de_cobro_anticipos[1]);
        if($data['saldon'] <= 0){
            unset($tipos_de_cobro[1]);
        }
        $espera = Espera::where('paciente_id', $id)->where('admitido', 1)->first();
        

        // no hay presupuestos que mostrar porque todos tienen los tratamientos realizados
        if (!$hay_presupuestos) {
            $presupuestos = array();
        }

        return View::make('historial.show')->with($data)
                            ->with(array('historiales' => $historiales, 'profesional' => $profesional,
                                         'presupuestos' => $presupuestos, 'profesionales_list' => $profesionales_list,
                                         'tipos_de_cobro' => $tipos_de_cobro, 'paciente' => $paciente,
                                         'p_d_c' => $p_d_c, 'espera' => $espera, 'saldo'=> $saldo_anticipos,
                                          'tipos_de_cobro_anticipos' => $tipos_de_cobro_anticipos));


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
         
    }
    
    public function elegir_prof()
    {
        $historial_id = Input::get('historial_id');
        $profesionales = Profesional::get()->lists('fullname', 'id');
        return View::make('historial.elegir_prof')->with('profesionales', $profesionales)->with('historial_id', $historial_id);
    }


    public function asignar_prof()
    {
        $historial = Historial_clinico::find(Input::get('historial_id'));
        $historial->profesional_id = Input::get('profesional_id');
        $historial->update();
        return Redirect::action('Historial_clinicoController@show', $historial->paciente_id);
    }

    public function coste_lab($id)
    {
        $historial = Historial_clinico::find($id);
        $historial->coste_lab = Input::get('coste_lab');
        $historial->update();
        $user = Auth::id();
        //$profesional = Profesional::where('user_id', $user)->firstOrFail();
        
        return Redirect::action('Historial_clinicoController@show', $historial->paciente_id);
    }

    public function cobrar($id)
    {
        $paciente = Pacientes::where('id', $id)->firstOrFail();
        //$paciente->saldo = $paciente->saldo + Input::get('cobrar');
        //$paciente->update();
        $user = Auth::id();
        $profesional = Profesional::where('user_id', $user)->firstOrFail();
        return Redirect::action('Historial_clinicoController@show', $paciente->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy()
    {
        //buscamos el historial para antes de borrarlo marcar lo tratamientos como no realizados si es que vienen de un presu para que puedan volver a ser adjuntados
        $historial = Historial_clinico::where('historial_clinico.id', Input::get('h_id'))->firstorFail();
        
        //ahora deberíamos encontrar en la tabla presupuestos_tratamientos el $historial->presupuesto_tratamiento_id para marcarlo como 0 en "presupuestos_tratamientos.estado".
        //aquí hay un error que tiene que ver con el model. El model presupuesotTratamiento extends Pivot y no sé como hacerlo reversible, es decir hacer lo siguiente, que me da error:
                                
        $presu_trat = DB::table('presupuestos_tratamientos')->where('id', $historial->presupuesto_tratamiento_id)->update(array('estado' => 0));
//        $presu_trat->estado = 0;
//        $presu_trat->update();
        $Paciente_id = $historial->paciente_id;
        $historial->delete();
        return Redirect::action('Historial_clinicoController@show', $Paciente_id);
                        
        //return Redirect::action('Historial_clinicoController@show', Input::get('h_p_id'))->with('message', 'Función no disponible - En pruebas');
        
    }

    public function busqueda()
    {
        $q_busca = Input::get('q', '');

        if ($q_busca != '') {
            $busca = '%'.$q_busca.'%';
            $pacientes = Pacientes::where(DB::raw('concat(pacientes.nombre, " ", pacientes.apellido1, " ", pacientes.apellido2)'), 'LIKE', $busca)
                                ->orWhere(DB::raw('concat(pacientes.apellido1, " ", pacientes.apellido2, " ", pacientes.nombre)'), 'LIKE', $busca)
                                ->orWhere('numerohistoria', 'LIKE', $busca)
                                ->get();
        } else {
            return Redirect::action('Historial_clinicoController@index');
        }
        return View::make('historial.busqueda')->with(array('pacientes' => $pacientes, 'busca' => $q_busca));
    }

}
