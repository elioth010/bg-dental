<?php

class TurnoController extends \BaseController {

    public function index()
    {
        if(null !== Input::get('cdate')) {
            $cdate = explode("-", Input::get('cdate'));
            $mes = $cdate[1];
            $ano = $cdate[0];
        } else {
            $mes = date("m");
            $ano = date("Y");
        }

        $user = User::where('id', Auth::id())->firstOrFail();
        $sede_ids = array();
        foreach($user->sedes as $sede) {
            $sede_ids[] = $sede->id;
        }

        if (in_array(4, $sede_ids)) {
            $eventos = Turnos::where('fecha_turno', 'LIKE', '%-'.$mes.'-%')
                                ->whereIn('sede_id', $sede_ids)
                                ->orderBy('fecha_turno')
                                ->get(array('fecha_turno', 'profesional_id'));
//          $events = array("2015-03-09 10:30:00" => array("Event 1","Event 2 <strong> with html</strong>",),"2015-03-09 14:12:23" => array("Event 3",),"2015-03-14 08:00:00" => array("Event 4",),);
        } else {
            //$eventos = Turnos::where('fecha_turno', 'LIKE', '%-'.$mes.'-%')->orderBy('fecha_turno')->get(array('fecha_turno', 'profesional_id', 'sede_id'));
            //Elegir la sede de la que se quieren ver los turnos.
            $sedes = Sedes::lists('nombre', 'id');
            return View::make('agenda.turnos_elegir_sede')->with('sedes' , $sedes);
        }

        $events = array();
        foreach($eventos as $evento){
            $profesionales = Profesional::find($evento->profesional_id);
            $events[$evento->fecha_turno] = array($profesionales->nombre.", ".$profesionales->apellido1);
        }

        $calendario = $this->getTurnoCalendar($events);

        //if (in_array(4, $sede_ids)) {
        $sedes = Sedes::all();
        return View::make('turnos.index')->with(array('calendario' => $calendario, 'sedes' => $sedes));
    }

    // TODO:MERGE
    public function index_tps() //Turno por sede...
    {
        if (null !== Input::get('cdate')) {
            $cdate = explode("-", Input::get('cdate'));
            $mes = $cdate[1];
            $ano = $cdate[0];
        } else {
            $mes = date("m");
            $ano = date("Y");
        }

        $sede_id = Input::get('sede');
        $sede = Sedes::find($sede_id);

        $eventos = Turnos::where('fecha_turno', 'LIKE', '%-'.$mes.'-%')->where('sede_id', $sede_id)->orderBy('fecha_turno')->get(array('fecha_turno', 'profesional_id'));
        //$events = array("2015-03-09 10:30:00" => array("Event 1","Event 2 <strong> with html</strong>",),"2015-03-09 14:12:23" => array("Event 3",),"2015-03-14 08:00:00" => array("Event 4",),);

        $events = array();
        foreach($eventos as $evento){
            $profesionales = Profesional::find($evento->profesional_id);
            $events[$evento->fecha_turno] = array($profesionales->nombre.", ".$profesionales->apellido1);
        }

        $calendario = $this->getTurnoCalendar($events);

        return View::make('agenda.turnos')->with('calendario' , $calendario)->with('sede', $sede);
    }

    public function create()
    {
        $user = User::where('id', Auth::id())->firstOrFail();
        $sede_ids = array();
        foreach($user->sedes as $sede) {
            echo $sede->id . '<br/>';
            $sede_ids[] = $sede->id;
        }

        if (in_array(4, $sede_ids)) {
            $sedes = Sedes::lists('nombre', 'id');
            return View::make('agenda.turnos_elegir_sede_a_crear')->with('sedes' , $sedes);
        } else {
            // TODO:TEST
            $profesionales = Profesional::where('sede_id', $sede_id)->get();
            //$sede_nombre = Sedes::lists('nombre')->where('sede_id', $sede_id);
            $option_prof = "";

            foreach($profesionales as $i=>$profesionales){
                    $option_prof .= "<option value =".$profesionales->id.">Dr. ".$profesionales->apellido1."</option>";
            }

            if(null !== Input::get('cdate')){
                $cdate = explode("-", Input::get('cdate'));
                $mes = $cdate[1];
                $ano = $cdate[0];
            } else {
                $mes = date("m");
                $ano = date("Y");
            }
    //            $numero = 1;
    //        var_dump($ano);
            $numero = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
            $i = 1;
            $events = array();
            $date;

            // TODO: loop
            while ($i<=$numero) {
                $select_prof_m = "<select class = \"select_prof\" name = \"profesional_id-m-" . $i . "\">" . $option_prof . "</select>";
                $date_in_m = $ano."-".$mes."-".$i." 10:00";
                $input_m = '<input  type = "hidden" name="dia-m-'.$i.'" value= "'.$date_in_m.'">';

                $select_prof_m2 = "<select class = \"select_prof\" name = \"profesional_id-m2-" . $i . "\">" . $option_prof . "</select><hr>";
                $date_in_m2 = $ano."-".$mes."-".$i." 10:01";
                $input_m2 = '<input  type = "hidden" name="dia-m2-'.$i.'" value= "'.$date_in_m2.'">';

                $select_prof_t = "<select class = \"select_prof\" name = \"profesional_id-t-" . $i . "\">" . $option_prof . "</select>";
                $date_in_t = $ano."-".$mes."-".$i." 13:00";
                $input_t = '<input  type = "hidden" name="dia-t-'.$i.'" value= "'.$date_in_t.'">';

                $select_prof_t2 = "<select class = \"select_prof\" name = \"profesional_id-t2-" . $i . "\">" . $option_prof . "</select>";
                $date_in_t2 = $ano."-".$mes."-".$i." 13:01";
                $input_t2 = '<input  type = "hidden" name="dia-t2-'.$i.'" value= "'.$date_in_t2.'">';



                $events1[$date_in_m] = array($input_m, $select_prof_m);
                $events2[$date_in_m2] = array($input_m2, $select_prof_m2);
                $events3[$date_in_t] = array($input_t, $select_prof_t);
                $events4[$date_in_t2] = array($input_t2, $select_prof_t2);
                $events = array_merge($events1, $events2, $events3, $events4);
                $i++;
            }

            $calendario = $this->getTurnoCalendar($events, '/turno/create');

            return View::make('agenda.crear_turnos')->with(array('calendario' => $calendario, 'numero_dias' => $numero, 'sede_id'=> $sede_id));
        }
    }

    // TODO:MERGE
    public function create_tps()
    {
        $sede_id = Input::get('sede');
        $sede = Sedes::find($sede_id);
        $profesionales = Profesional::leftJoin('sedes_profesionales', 'sedes_profesionales.profesional_id', '=', 'profesionales.id')
                        ->select('profesionales.id', DB::raw('concat (profesionales.nombre," ",profesionales.apellido1) as nombre_p'))
                        ->lists('nombre_p', 'id');
                        //->get();

        return View::make('agenda.crear_turnos_tps')->with(array('profesionales' => $profesionales))->with('sede', $sede);
    }

    public function store()
    {
        $sede_id = Input::get('sede_id');
        $turnos = Input::all();

        for ($i = 0; $i < 5; $i++) {
            $evento = new Turnos;
            $evento->fecha_turno = Input::get('sede_id');$turnos["dia-m-".$i];
            $evento->profesional_id = $turnos['profesional_id-m-'.$i] ;
            $evento->sede_id = $sede_id;
            // TODO: mañana
            $evento->save();
        }

        for ($i = 0; $i < 5; $i++) {
            $evento = new Turnos;
            $evento->fecha_turno = $turnos["dia-m2-".$i];
            $evento->profesional_id = $turnos['profesional_id-m2-'.$i] ;
            // TODO: mañana
            $evento->sede_id = $sede_id;
            $evento->save();
        }

        for ($i = 0; $i < 5; $i++) {
            $evento = new Turnos;
            $evento->fecha_turno = $turnos["dia-t-".$i];
            $evento->profesional_id = $turnos['profesional_id-t-'.$i] ;
            // TODO: tarde
            $evento->sede_id = $sede_id;
            $evento->save();
        }

        for ($i = 0; $i < 5; $i++) {
            $evento = new Turnos;
            $evento->fecha_turno = $turnos["dia-t2-".$i];
            $evento->profesional_id = $turnos['profesional_id-t2-'.$i] ;
            // TODO: tarde
            $evento->sede_id = $sede_id;
            $evento->save();
        }

        return Redirect::action('TurnoController@index');
    }

    // $id = $sede_id
    public function show($id)
    {
        $user = User::where('id', Auth::id())->firstOrFail();

        $sede_ids = array();
        foreach($user->sedes as $sede) {
            $sede_ids[] = $sede->id;
        }

        $sede = Sedes::where('id', $id)->firstOrFail();

        if (null !== Input::get('cdate')) {
            $cdate = explode("-", Input::get('cdate'));
            $mes = $cdate[1];
            $ano = $cdate[0];
        } else {
            $mes = date("m");
            $ano = date("Y");
        }

        if ((in_array($id, $sede_ids)) || (in_array(4, $sede_ids))) {
            $eventos = Turnos::where('fecha_turno', 'LIKE', '%-'.$mes.'-%')
                                ->whereIn('sede_id', $sede_ids)
                                ->orderBy('fecha_turno')
                                ->get(array('fecha_turno', 'profesional_id'));
        } else {
            // TODO: NO TIENES PERMISOS
        }

        $events = array();
        foreach($eventos as $evento){
            $profesionales = Profesional::find($evento->profesional_id);
            $events[$evento->fecha_turno] = array($profesionales->nombre.", ".$profesionales->apellido1);
        }

        $cal = Calendar::make();
        $cal->setDayLabels(array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'));
        //$cal->setStartWeek('L');
        $cal->setBasePath('/turno'); // Base path for navigation URLs
        $cal->setDate(Input::get('cdate')); //Set starting date
        $cal->showNav(true); // Show or hide navigation
        $cal->setMonthLabels(array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre')); //Month names
        $cal->setEvents($events); // Receives the events array
        $cal->setTableClass('table_cal'); //Set the table's class name
        $calendario = $cal->generate();

        return View::make('turnos.show')->with(array('calendario' => $calendario, 'sede' => $sede));
    }

    public function edit($sede_id)
    {
        $user = User::where('id', Auth::id())->firstOrFail();

        $sede_ids = array();
        foreach($user->sedes as $sede) {
            $sede_ids[] = $sede->id;
        }

        $sede = Sedes::where('id', $sede_id)->firstOrFail();

        if (null !== Input::get('cdate')) {
            $cdate = explode("-", Input::get('cdate'));
            $mes = $cdate[1];
            $ano = $cdate[0];
        } else {
            $mes = date("m");
            $ano = date("Y");
        }

        if ((in_array($sede_id, $sede_ids)) || (in_array(4, $sede_ids))) {
            $eventos = Turnos::where('fecha_turno', 'LIKE', '%-'.$mes.'-%')
                                ->whereIn('sede_id', $sede_ids)
                                ->orderBy('fecha_turno')
                                ->get(array('fecha_turno', 'profesional_id'));
        } else {
            // TODO: NO TIENES PERMISOS
        }

        $events = array();
        foreach($eventos as $evento){
            $profesionales = Profesional::find($evento->profesional_id);
            $events[$evento->fecha_turno] = array($profesionales->nombre.", ".$profesionales->apellido1);
        }

        $calendario = $this->getTurnoCalendar($events);

        return View::make('turnos.edit')->with(array('calendario' => $calendario, 'sede' => $sede));
    }

    private function getTurnoCalendar($events, $basepath = '/turno') {
        $cal = Calendar::make();
        $cal->setDayLabels(array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'));
        //$cal->setStartWeek('L');
        $cal->setBasePath($basepath); // Base path for navigation URLs
        $cal->setDate(Input::get('cdate')); //Set starting date
        $cal->showNav(true); // Show or hide navigation
        $cal->setMonthLabels(array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre')); //Month names
        $cal->setEvents($events); // Receives the events array
        $cal->setTableClass('table_cal'); //Set the table's class name

        return $cal->generate();
    }

    public function update($id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }


}
