<?php

class TurnoController extends \BaseController {

    public function index()
    {
        if(Input::has('cdate')) {
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

        if ($date_1 < $date_2) {
            return Redirect::action('TurnoController@index')->with('message', 'No se puede crear un turno para un mes anterior.');
        }

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
                $turno->profesional_id = 0;
                $turno->sede_id = $sede_id;
                $turno->save();
            }
        }

        //$count = Turnos::where('fecha_turno', 'LIKE', "$date_1-%")->where('sede_id', $sede_id)->count();
        //return "Creados $count registros nuevos.";
        return Redirect::action('TurnoController@showMonth', array($sede_id, $year, $month));
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
        $turno = Turnos::where('sede_id', $sede_id)->orderBy('fecha_turno', 'DESC')->take(1)->first();
        // crea array $changes
        $changes = array();

        if (count($turno) > 0) {
            $date = explode('-', $turno->fecha_turno);
            $date_3 = $date[0] . '-' . $date[1] . '-' . ($date[2] - 7);
            $turnos = Turnos::where('sede_id', $sede_id)->where('fecha_turno', '>', $date_3)->orderBy('fecha_turno', 'DESC')->get();
            // los 7 últimos

            foreach($turnos as $turno) {
                $date = explode('-', $turno->fecha_turno);
                $weekdaynum = date('w', mktime(0, 0, 0, $date[1], $date[2], $date[0])); // 0 (domingo) - 6 (sábado)
                $changes[$weekdaynum][$turno->tipo_turno] = $turno->profesional_id;
            }

        } else {
            //al inicio no hay ninguno
            $query = array('sede' => $sede_id, 'cdate' => $year.'-'.$month);
            return Redirect::action('TurnoController@createdummy', $query);
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

        //return 'Creado mes:' . Input::get('cdate');
        //return Redirect::action('TurnoController@create')->with('message', 'Se crea turno para:' . $year . '-' . $month);
        return Redirect::action('TurnoController@showMonth', array($sede_id, $year, $month));
    }

    public function store()
    {

    }

    public function show($sede_id) {
        $mes = date("m");
        $ano = date("Y");
        return Redirect::action('TurnoController@showMonth', array($sede_id, $ano, $mes));
    }
    /*
        $turnosArray:
            array(
            ['01'] => array(['M1'] => array(1 => 'Pepito'), ['M2'] => array(3 => 'Manuela'), ...)
            ['02'] => array(['M1'] => array(1 => 'Pepito'), ['M2'] => array(3 => 'Manuela'), ...)
            ...
            )
    */
    public function showMonth($sede_id, $ano, $mes)
    {
        if (Input::has('cdate')) {
            $cdate = explode('-', Input::get('cdate'));
            return Redirect::action('TurnoController@showMonth', array($sede_id, $cdate[0], $cdate[1]));
        }

        $user = User::where('id', Auth::id())->firstOrFail();
        $sede = Sedes::where('id', $sede_id)->firstOrFail();

        $turnos = Turnos::where('fecha_turno', 'LIKE', "$ano-$mes-%")
                                ->where('sede_id', $sede_id)
                                ->orderBy('fecha_turno')
                                ->get(array('fecha_turno', 'profesional_id', 'tipo_turno'));

        //-----------------------------------------
        // Si no existe turno para ese mes, crearlo a partir del anterior
        if (count($turnos) == 0) {
            $query = array('sede' => $sede_id, 'cdate' => $ano.'-'.$mes);
            return Redirect::action('TurnoController@create', $query);
        }

        $turnosArray = array(); // para uso posterior en JS de la vista
        $turnosHtml = array();
        foreach($turnos as $turno) {
            $profesional = Profesional::find($turno->profesional_id);
            $turnosHtml[$turno->fecha_turno][$turno->tipo_turno] = $this->getHtmlProfRow($turno->tipo_turno, $turno->fecha_turno, $profesional);

            // $turnosArray
            $day = explode('-', $turno->fecha_turno)[2];
            if ($profesional !== null) {
                $turnosArray[$day][$turno->tipo_turno] = array($turno->profesional_id, "$profesional->nombre $profesional->apellido1");
            } else {
                $turnosArray[$day][$turno->tipo_turno] = array($turno->profesional_id, "");
            }
        }

        $events = array();
        $turnosHtmlSelect = $this->getHtmlProfesionalesSedeSelects($sede_id, $turnos);
        foreach($turnosHtml as $fecha => $value) {
            $div = $this->getHtmlCasillaCalendario($fecha, $turnosHtml, $turnosHtmlSelect);
            $events[$fecha] = array($div);
        }

        $calendario = $this->getTurnoCalendar($events,  $ano.'-'.$mes, '/turno/' . $sede_id);

        $d = gregoriantojd($mes, 1, $ano);
        $fecha = jdmonthname($d, 1) . ' de ' . $ano;
        return View::make('turnos.show')->with(array('calendario' => $calendario, 'sede' => $sede, 'fecha' => $fecha));
    }

    private function getHtmlCasillaCalendario($fecha, $turnosHtml, $turnosHtmlSelect) {
        $day = explode('-', $fecha)[2];

        $div = "<div id=\"turnosdia-$day\" class=\"turnosdia\">";
        $div .= $turnosHtml[$fecha]['M1'];
        $div .= $turnosHtml[$fecha]['M2'];
        $div .= $turnosHtml[$fecha]['T1'];
        $div .= $turnosHtml[$fecha]['T2'];
        $div .= "</div>";
        $div .= "<div id=\"selectturnosdia-$day\" class=\"selectturnosdia\">";
        $div .= $turnosHtmlSelect[$fecha];
        $div .= "</div>";
        $botones = $this->getHtmlBotones($day);
        $div .= $botones;

        return $div;
    }

    public function edit($sede_id) {
        $mes = date("m");
        $ano = date("Y");
        return Redirect::action('TurnoController@editMonth', array($sede_id, $ano, $mes));
    }

    public function editMonth($sede_id, $ano, $mes)
    {
        $sede = Sedes::where('id', $sede_id)->firstOrFail();
        $user = User::where('id', Auth::id())->firstOrFail();

        $turnos = Turnos::where('fecha_turno', 'LIKE', "$ano-$mes-%")
                                ->where('sede_id', $sede_id)
                                ->orderBy('fecha_turno')
                                ->get(array('fecha_turno', 'profesional_id'));

        $today = date("Y-m-d");
        $daytoday = explode('-', $today)[2];

        $selects = $this->getProfesionalesSedeSelects($sede_id);

        $i = 0;
        $events = array();
        while($i <= 7) {
            $date_in = date('Y-m-d', mktime(0, 0, 0, $mes, $daytoday + $i, $ano));

            // TODO:
            if ($date_in > $today) {
                $events[$date_in] = $selects[$date_in];
            }

            $i++;
        }

        $tomorrow = date('Y-m-d', mktime(0, 0, 0, $mes, $daytoday + 1, $ano));
        $calendario = $this->getTurnoSemanaCalendar($events, $tomorrow, '/turno/' . $sede_id);

        return View::make('turnos.edit')->with(array('calendario' => $calendario, 'sede' => $sede, 'year' => $ano, 'month' => $mes));
    }

    /* */
    private function getHtmlBotones($day) {
        $botones = "<div>";
        $botones .= "<button id='modifbutton-$day' type='button' class='botonl' onclick='modificarTurnoClick(\"$day\")'>Modificar</button>";
        $botones .= "<button id='modifbuttons-$day' type='button' class='botonl modifsavebutton' onclick='modificarTurnoSave(\"$day\")'>Guardar</button>";
        $botones .= "<button id='modifbuttonc-$day' type='button' class='botonl modifcancelbutton' onclick='modificarTurnoCancel(\"$day\")'>Cancelar</button>";
        $botones .= "<button id='incidbutton-$day' type='button' class='botonl' onclick='incidenciaClick(\"$day\")'>Incidencias</button>";
        $botones .= "<div>";
        return $botones;
    }

    private function getHtmlProfesionalesSedeSelects($sede_id, $turnos, $add_empty = TRUE) {
        $profesionales = Profesional::leftJoin('sedes_profesionales', 'sedes_profesionales.profesional_id', '=', 'profesionales.id')
                            ->where('sedes_profesionales.sede_id', $sede_id)
                            ->select('profesionales.id', 'profesionales.apellido1', 'profesionales.nombre')
                            ->get();

        $options = $this->getProfOptions($turnos, $add_empty, $profesionales);

        $selecteds = array();
        foreach($options as $fecha=>$opts) {
            $day = explode('-', $fecha)[2];

            $div = "";
            $div .= $this->getHtmlProfSelect('M1', $day, $options[$fecha]['M1']);
            $div .= $this->getHtmlProfSelect('M2', $day, $options[$fecha]['M2']);
            $div .= $this->getHtmlProfSelect('T1', $day, $options[$fecha]['T1']);
            $div .= $this->getHtmlProfSelect('T2', $day, $options[$fecha]['T2']);
            $selecteds[$fecha] = $div;
        }

        return $selecteds;
    }
    /* Genera una lista de opciones para un select con los profesionales de una sede específica */
    private function getProfesionalesSedeSelects($sede_id, $add_empty = TRUE) {
        $today = date("Y-m-d");
        $todayexp = explode('-', $today);
        $date = strtotime("+7 day", date('U', mktime(0, 0, 0, $todayexp[1], $todayexp[2], $todayexp[0])));
        $nextdate = date('Y-m-d', $date);
        $turnos = Turnos::whereBetween('fecha_turno', array($today, $nextdate))->get();

        $profesionales = Profesional::leftJoin('sedes_profesionales', 'sedes_profesionales.profesional_id', '=', 'profesionales.id')
                            ->where('sedes_profesionales.sede_id', $sede_id)
                            ->select('profesionales.id', 'profesionales.apellido1', 'profesionales.nombre')
                            ->get();

        $options = $this->getProfOptions($turnos, $add_empty, $profesionales);

        $selecteds = array();
        foreach($options as $fecha=>$opts) {
            $day = explode('-', $fecha)[2];

            $select_m1 = $this->getProfSelect('M1', $day, $options[$fecha]['M1']);
            $select_m2 = $this->getProfSelect('M2', $day, $options[$fecha]['M2']);
            $select_t1 = $this->getProfSelect('T1', $day, $options[$fecha]['T1']);
            $select_t2 = $this->getProfSelect('T2', $day, $options[$fecha]['T2']);
            $selecteds[$fecha] = array_merge($select_m1, $select_m2, $select_t1, $select_t2);
        }

        return $selecteds;
    }

    /* Cada fila con el nombre del profesional en una casilla del calendario */
    private function getHtmlProfRow($tipo, $fecha, $profesional) {
        $div = "";
        $day = explode('-', $fecha)[2];
        $div .= "<div id='rowturno-$day-$tipo' class='rowturno'>";
        if ($profesional !== null ){
            $div .= "$tipo: $profesional->nombre $profesional->apellido1";
        } else {
            $div .= "$tipo: Sin asignar";
        }
        $div .= '</div>';
        return $div;
    }

    /* Crea un array con los <option> para los turnos de cada día */
    private function getProfOptions($turnos, $add_empty, $profesionales) {
        $options = array();

        foreach($turnos as $turno) {
            $options[$turno->fecha_turno][$turno->tipo_turno] = "";

            if ($add_empty) {
                $options[$turno->fecha_turno][$turno->tipo_turno] .= '<option value="0">--</option>';
            }

            foreach($profesionales as $profesional) {
                $selected = $profesional->id == $turno->profesional_id ? "selected" : "";
                $options[$turno->fecha_turno][$turno->tipo_turno] .= "<option value=\"$profesional->id\" $selected>$profesional->nombre $profesional->apellido1</option>";
            }
        }
        return $options;
    }

    private function getHtmlProfSelect($tipo, $day, $options) {
        $div = '<div class="rowturno">';
        $div .= $tipo . ': <select class="select_prof" name="profesional_id-' . $tipo . '-' . $day . '">' . $options . "</select>";
        $div .= '</div>';
        return $div;
    }

    /* Crea un array con el <select> para los turnos de cada día */
    private function getProfSelect($tipo, $day, $options) {
        $div = '<div class="rowturno">';
        $div .= $tipo . ': <select class="select_prof" name="profesional_id-' . $tipo . '-' . $day . '">' . $options . "</select>";
        $div .= '</div>';
        return array($div);
    }

    private function getTurnoCalendar($events, $date, $basepath = '/turno') {
        $cal = Calendar::make();
        $cal->setDayLabels(array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'));
        $cal->setBasePath(Input::get('cdate')); // Base path for navigation URLs
        $cal->setDate($date); //Set starting date
        $cal->showNav(true); // Show or hide navigation
        //$cal->setView('week');
        $cal->setEventsWrap(array('', ''));
        //$cal->setEventsWrap(array('<div><p>', '</p></div>'));
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

                $evento = Turnos::where(array('fecha_turno' => $eventdate, 'tipo_turno' => $turno, 'sede_id' => $sede_id))->firstOrFail();
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
