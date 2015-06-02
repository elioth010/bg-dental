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
            $sedes = Sedes::where('id', '!=', 4)->get();
        } else {
            $sedes = Sedes::whereIn('id', $sede_ids)->get();
        }

        return View::make('turnos.index')->with(array('sedes' => $sedes));
    }

    /* URL: /turno/create?cdate=2015-04&sede=2 */
    // http://bgdental.local/turno/createdummy?cdate=2015-04&sede=2
    // DELETE FROM `turnos` WHERE fecha_turno LIKE '2015-04-%'
    public function createdummy() {
        if (Input::has('sede')) {
            $sede_id = Input::get('sede');
        } else {
            return 'No se ha especificado la sede.';
        }

        if (Input::has('cdate')) {
            $cdate = explode("-", Input::get('cdate'));
            $year = $cdate[0];
            $month = $cdate[1];
            $date_1 = "$year-$month";
        } else {
            return 'No se ha especificado el mes a crear.';
        }

        $today = explode("-", date("Y-m-d"));
        $date_2 = "$today[0]-$today[1]";

        /*
        if ($date_1 < $date_2) {
            return Redirect::action('TurnoController@index')->with('message', 'No se puede crear un turno para un mes anterior.');
        }
        */

        $turnos = Turnos::where('fecha_turno', 'LIKE', "$date_1-%")->where('sede_id', $sede_id)->take(1)->get();
        if (count($turnos) > 0) {
            return 'Ya existen turnos para ese mes.';
        }

        $dias = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $tipos_turnos = array('M1', 'M2', 'T1', 'T2');
        for($d=1; $d <= $dias; $d++) {
            foreach($tipos_turnos as $tipo) {
                $turno = new Turnos;
                $turno->fecha_turno = date('Y-m-d', mktime(0, 0, 0, $month, $d, $year));
                $turno->tipo_turno = $tipo;
                $turno->profesional_id = 1;
                $turno->sede_id = $sede_id;
                $turno->save();
            }
        }

        $count = Turnos::where('fecha_turno', 'LIKE', "$date_1-%")->where('sede_id', $sede_id)->count();
        return "Creados $count registros nuevos.";
    }

    /* URL: /turno/create?cdate=2015-07 */
    // http://bgdental.local/turno/create?cdate=2015-07&sede=2
    public function create()
    {
        if (Input::has('sede')) {
            $sede_id = Input::get('sede');
        } else {
            return Redirect::action('TurnoController@index')->with('message', 'No se ha especificado la sede.');
        }

        if (Input::has('cdate')) {
            $cdate = explode("-", Input::get('cdate'));
            $year = $cdate[0];
            $month = $cdate[1];
            $date_1 = "$year-$month";
        } else {
            return Redirect::action('TurnoController@index')->with('message', 'No se ha especificado el mes a crear.');
        }

        $today = explode("-", date("Y-m-d"));
        $date_2 = "$today[0]-$today[1]";

        if ($date_1 < $date_2) {
            return Redirect::action('TurnoController@index')->with('message', 'No se puede crear un turno para un mes anterior.');
        }

        $turnos = Turnos::where('fecha_turno', 'LIKE', "$date_1-%")->where('sede_id', $sede_id)->take(1)->get();
        if (count($turnos) > 0) {
            return Redirect::action('TurnoController@index')->with('message', 'Ya existen turnos para ese mes.');
        }

        // coger los ultimos para repetirlos
        $turno = Turnos::where('sede_id', $sede_id)->orderBy('fecha_turno', 'DESC')->take(1)->firstOrFail();
        $date = explode('-', $turno->fecha_turno);
        $date_3 = $date[0] . '-' . $date[1] . '-' . ($date[2] - 7);
        $turnos = Turnos::where('sede_id', $sede_id)->where('fecha_turno', '>', $date_3)->orderBy('fecha_turno', 'DESC')->get();
        // los 7 últimos

        // crea array $changes
        $changes = array();
        foreach($turnos as $turno) {
            $date = explode('-', $turno->fecha_turno);
            $weekdaynum = date('w', mktime(0, 0, 0, $date[1], $date[2], $date[0])); // 0 (domingo) - 6 (sábado)
            $changes[$weekdaynum][$turno->tipo_turno] = $turno->profesional_id;
        }

        $dias = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $tipos_turnos = array('M1', 'M2', 'T1', 'T2');
        for($d=1; $d <= $dias; $d++) {
            foreach($tipos_turnos as $tipo) {
                $weekdaynum = date('w', mktime(0, 0, 0, $month, $d, $year));

                $turno = new Turnos;
                $turno->fecha_turno = date('Y-m-d', mktime(0, 0, 0, $month, $d, $year));
                $turno->tipo_turno = $tipo;
                $turno->profesional_id = $changes[$weekdaynum][$tipo];
                $turno->sede_id = $sede_id;
                $turno->save();
            }
        }

        //return Redirect::action('TurnoController@create')->with('message', 'Se crea turno para:' . $year . '-' . $month);
    }

    public function store()
    {

    }

    public function show($sede_id)
    {
        $user = User::where('id', Auth::id())->firstOrFail();
        $sede = Sedes::where('id', $sede_id)->firstOrFail();

        $sede_ids = array();
        foreach($user->sedes as $s) {
            $sede_ids[] = $s->id;
        }

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
                                ->where('sede_id', $sede_id)
                                ->orderBy('fecha_turno')
                                ->get(array('fecha_turno', 'profesional_id', 'tipo_turno'));
        } else {
            // TODO: NO TIENES PERMISOS
        }

        $events = array();
        foreach($eventos as $evento) {
            $profesional = Profesional::find($evento->profesional_id);
            if ($profesional !== null ){
                $newarr = array("$evento->tipo_turno: $profesional->nombre, $profesional->apellido1");
            } else {
                $newarr = array("$evento->tipo_turno: Sin asignar");
            }

            if (isset($events[$evento->fecha_turno])) {
                $events[$evento->fecha_turno] = array_merge($events[$evento->fecha_turno], $newarr);
            } else {
                $events[$evento->fecha_turno] = $newarr;
            }
        }

        foreach($events as $key=>$value) {
            asort($events[$key]);
        }

        $calendario = $this->getTurnoCalendar($events, '/turno/' . $sede_id);

        $d = gregoriantojd($mes, 1, $ano);
        $fecha = jdmonthname($d, 1) . ' de ' . $ano;
        return View::make('turnos.show')->with(array('calendario' => $calendario, 'sede' => $sede, 'fecha' => $fecha));
    }

    /*
        $sede = Sedes::find($sede_id);
        //$profesionales = Profesional::where('sede_id', $sede_id)->get();
        $profesionales = Profesional::leftJoin('sedes_profesionales' , 'sedes_profesionales.profesional_id', '=' , 'profesionales.id')->where('sedes_profesionales.sede_id', $sede_id)->get();
        $option_prof="";
        foreach($profesionales as $i=>$profesionales){
                $option_prof .= "<option value =".$profesionales->id.">Dr. ".$profesionales->apellido1." ".$profesionales->apellido1."</option>";
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

        while($i<=$numero){
            $select_prof = "<select class = \"select_prof\" name = \"profesional_id-" . $i . "\">" . $option_prof . "</select>";
            $date_in = $ano."-".$mes."-".$i;
            $input = '<input  type = "hidden" name="dia-'.$i.'" value= "'.$date_in.'">';
            $events[$date_in] = array($input, $select_prof);
            $i++;
        }
        //            for($i;$i<=$numero;$i++){
        //                  $date_in = $ano."-".$mes."-".$i;
        //                  $input = "<input  type = \"hidden\" name=\"dia\" value= ".$date_in.">";
        //                  $events[$date_in] = array($input, $select_prof);
        //            }

        $calendario = $this->getCalendar($events);

        return View::make('agenda.crear_guardias')->with('calendario', $calendario)->with('numero_dias', $numero)->with('sede', $sede);
    */

    // TODO: Preseleccionar. Necesitamos $selecteds[$fecha][$turno]
    public function edit($sede_id)
    {
        $sede = Sedes::where('id', $sede_id)->firstOrFail();
        $user = User::where('id', Auth::id())->firstOrFail();

        $sede_ids = array();
        foreach($user->sedes as $s) {
            $sede_ids[] = $s->id;
        }

        if (null !== Input::get('cdate')) {
            $cdate = explode("-", Input::get('cdate'));
            $mes = $cdate[1];
            $ano = $cdate[0];
        } else {
            $mes = date("m");
            $ano = date("Y");
        }

        // permisos
        if ((in_array($sede_id, $sede_ids)) || (in_array(4, $sede_ids))) {
            $eventos = Turnos::where('fecha_turno', 'LIKE', '%-'.$mes.'-%')
                                ->where('sede_id', $sede_id)
                                ->orderBy('fecha_turno')
                                ->get(array('fecha_turno', 'profesional_id'));
        } else {
            // TODO: NO TIENES PERMISOS
        }

        $today = date("Y-m-d");
        $daytoday = explode('-', $today)[2];

        $selects = $this->getProfesionalesSedeSelects($sede_id);

        $i = 0;
        $events = array();

        /*
        foreach($eventos as $evento) {
            if ($evento->fecha_turno > $today) {
                $profesional = Profesional::where('id', $evento->profesional_id)->firstOrFail();
                $events[$evento->fecha_turno] = array($profesional->nombre . ", " . $profesional->apellido1);
            } else {
                $select_prof = '<select class ="select_prof" name="profesional_id-' . $evento->profesional_id . '">' . $option_prof . "</select>";
                $input = '<input type = "hidden" name="dia-'. $i .'" value= "'.$date_in.'">';
                $events[$evento->fecha_turno] = array($input, $select_prof);
            }
        }
        */

        // TODO:
        //$turnos = Turnos::where('fecha_turno', '<', Carbon::now()->addWeek());

        //var_dump($selecteds);die;
        while($i <= 7) {
            $date_in = date('Y-m-d', mktime(0, 0, 0, $mes, $daytoday + $i, $ano));

            if ($date_in > $today) {
                echo $date_in;
                $events[$date_in] = $selects[$date_in];
            }

            /*else {
                $m1 = array('M1: ');
                $m2 = array('M2: ');
                $t1 = array('T1: ');
                $t2 = array('T2: ');
                $events[$date_in] = array_merge($m1, $m2, $t1, $t2);
                // TODO: pintar nombres
                //$events[$date_in] = array($profesionales->nombre.", ".$profesionales->apellido1);
            }*/

            $i++;
        }

        //$events = array();
        //$events['2015-06-06'] = array('old');
        //$events['2015-06-20'] = array();
        $tomorrow = date('Y-m-d', mktime(0, 0, 0, $mes, $daytoday + 1, $ano));

        $calendario = $this->getTurnoSemanaCalendar($events, $tomorrow, '/turno/' . $sede_id);


        $d = gregoriantojd($mes, 1, $ano);
        $fecha = jdmonthname($d, 1) . ' de ' . $ano;
        return View::make('turnos.edit')->with(array('calendario' => $calendario, 'sede' => $sede, 'today' => $today, 'fecha' => $fecha));
    }

    /* Genera una lista de opciones para un select con los profesionales de una sede específica */
    private function getProfesionalesSedeSelects($sede_id, $add_empty = TRUE) {
        $options = array();
        $today = date("Y-m-d");
        $todayexp = explode('-', $today);
        $date = strtotime("+7 day", date('U', mktime(0, 0, 0, $todayexp[1], $todayexp[2], $todayexp[0])));
        $nextdate = date('Y-m-d', $date);
        //$turnos = Turnos::where('fecha_turno', '>=', $today)->where('fecha_turno', '<=', $nextdate)->get();
        $turnos = Turnos::whereBetween('fecha_turno', array($today, $nextdate))->get();

        $profesionales = Profesional::leftJoin('sedes_profesionales', 'sedes_profesionales.profesional_id', '=', 'profesionales.id')
                            ->where('sedes_profesionales.sede_id', $sede_id)
                            ->select('profesionales.id', 'profesionales.apellido1', 'profesionales.apellido2')
                            ->get();

        $selecteds = array();
        foreach($turnos as $turno) {
            $selecteds[$turno->fecha_turno][$turno->tipo_turno] = $turno->profesional_id;
            $options[$turno->fecha_turno][$turno->tipo_turno] = "";

            if ($add_empty) {
                $options[$turno->fecha_turno][$turno->tipo_turno] .= '<option value="0">--</option>';
            }

            foreach($profesionales as $profesional) {
                $selected = $profesional->id == $turno->profesional_id ? "selected" : "";
                $options[$turno->fecha_turno][$turno->tipo_turno] .= "<option value=\"$profesional->id\" $selected>Dr. $profesional->apellido1 $profesional->apellido2</option>";
            }
        }

        foreach($options as $fecha=>$opts) {
            $date = explode('-', $fecha);
            $day = $date[2];

            $select_prof_m1 = array('M1: <select class ="select_prof" name="profesional_id-M1-' . $day . '">' . $options[$turno->fecha_turno]['M1'] . "</select>");
            $select_prof_m2 = array('M2: <select class ="select_prof" name="profesional_id-M2-' . $day . '">' . $options[$turno->fecha_turno]['M2'] . "</select>");
            $select_prof_t1 = array('T1: <select class ="select_prof" name="profesional_id-T1-' . $day . '">' . $options[$turno->fecha_turno]['T1'] . "</select>");
            $select_prof_t2 = array('T2: <select class ="select_prof" name="profesional_id-T2-' . $day . '">' . $options[$turno->fecha_turno]['T2'] . "</select>");
            $selecteds[$fecha] = array_merge($select_prof_m1, $select_prof_m2, $select_prof_t1, $select_prof_t2);
        }

        return $selecteds;
    }

    private function getTurnoCalendar($events, $basepath = '/turno') {
        $cal = Calendar::make();
        $cal->setDayLabels(array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'));
        $cal->setBasePath(Input::get('cdate')); // Base path for navigation URLs
        $cal->setDate(Input::get('cdate')); //Set starting date
        $cal->showNav(true); // Show or hide navigation
        //$cal->setView('week');
        $cal->setMonthLabels(array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre')); //Month names
        $cal->setEvents($events); // Receives the events array
        $cal->setTableClass('table_cal'); //Set the table's class name

        return $cal->generate();
    }

    private function getTurnoSemanaCalendar($events, $startingDate, $basepath = '/turno') {
        $cal = Calendar::make();
        $cal->setDayLabels(array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'));
        $cal->setBasePath($basepath); // Base path for navigation URLs
        $cal->setDate($startingDate);
        //$cal->setDate('2015-06-23'); //Set starting date: today
        $cal->showNav(true); // Show or hide navigation
        $cal->setView('turno');
        $cal->setStartEndHours(8, 10);
        $cal->setMonthLabels(array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre')); //Month names
        $cal->setEvents($events); // Receives the events array
        $cal->setTableClass('table_cal'); //Set the table's class name

        return $cal->generate();
    }

    public function update($sede_id)
    {
        $today = Input::get('today');
        $today2 = explode("-", $today);
        $year = $today2[0];
        $month = $today2[1];

        $changes = array(); // changes per weekday

        foreach(Input::all() as $key => $profesional_id) {

            // TODO: $value == "0"
            if (strpos($key, 'profesional_id') === 0) {
                $values = explode("-", $key); // profesional_id-TT-DD

                $turno = $values[1];
                $day = $values[2];

                $weekdaynum = date('w', mktime(0, 0, 0, $month, $day, $year)); // 0 (domingo) - 6 (sábado)
                $changes[$weekdaynum][$turno] = $profesional_id;

                $eventdate = date('Y-m-d', mktime(0, 0, 0, $month, $day, $year));

                $evento = Turnos::where('fecha_turno', $eventdate)->where('tipo_turno', $turno)->where('sede_id', $sede_id)->firstOrFail();
                $evento->profesional_id = $profesional_id;
                $evento->update();
            }
        }

        $day = $today2[2];

        // Cambiar los siguientes: $today + 7
        $date = strtotime("+7 day", date('U', mktime(0, 0, 0, $month, $day, $year)));
        $nextdate = date('Y-m-d', $date);

        $turnos = Turnos::where('fecha_turno', '>=', $nextdate)->where('sede_id', $sede_id)->get();
        foreach($turnos as $turno) {
            $date = explode('-', $turno->fecha_turno);
            $weekdaynum = date('w', mktime(0, 0, 0, $date[1], $date[2], $date[0]));
            $turno->profesional_id = $changes[$weekdaynum][$turno->tipo_turno];
            $turno->update();
        }

        return Redirect::action('TurnoController@show', $sede_id);
    }

    public function destroy($id)
    {
        //
    }


}
