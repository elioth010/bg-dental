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
                                ->get();

        //-----------------------------------------
        // Si no existe turno para ese mes, crearlo a partir del anterior
        if (count($turnos) == 0) {
            $query = array('sede' => $sede_id, 'cdate' => $ano.'-'.$mes);
            return Redirect::action('TurnoController@create', $query);
        }

        $turnosArray = array();
        $turnosHtml = array();
        $incidenciasArray = array();
        foreach($turnos as $turno) {
            $profesional = Profesional::find($turno->profesional_id);
            $turnosHtml[$turno->fecha_turno][$turno->tipo_turno] = $this->getHtmlProfRow($turno, $profesional);

            // $turnosArray
            $day = explode('-', $turno->fecha_turno)[2];
            if ($profesional !== null) {
                $turnosArray[$day][$turno->tipo_turno] = array($turno->profesional_id, "$profesional->nombre $profesional->apellido1");
            } else {
                $turnosArray[$day][$turno->tipo_turno] = array($turno->profesional_id, "");
            }

            $incidenciasArray[$day][$turno->tipo_turno] = $turno->incidencia_text;
        }

        $events = array();
        $turnosHtmlSelect = $this->getHtmlProfesionalesSedeSelects($sede_id, $turnos);
        foreach($turnosHtml as $fecha => $value) {
            $div = $this->getHtmlCasillaCalendario($fecha, $sede_id, $turnosHtml, $turnosHtmlSelect);
            $events[$fecha] = array($div);
        }

        $calendario = $this->getTurnoCalendar($events,  $ano.'-'.$mes, '/turno/' . $sede_id);

        $d = gregoriantojd($mes, 1, $ano);
        $fecha = jdmonthname($d, 1) . ' de ' . $ano;
        return View::make('turnos.show')->with(array('calendario' => $calendario, 'sede' => $sede, 'fecha' => $fecha, 'incidencias' => $incidenciasArray));
    }

    /* */
    private function getHtmlCasillaCalendario($fecha, $sede_id, $turnosHtml, $turnosHtmlSelect) {
        $exp = explode('-', $fecha);
        $year = $exp[0];
        $month = $exp[1];
        $day = $exp[2];

        $div = "<div id=\"turnosdia-$day\" class=\"turnosdia\">";
        $div .= $turnosHtml[$fecha]['M1'];
        $div .= $turnosHtml[$fecha]['M2'];
        $div .= $turnosHtml[$fecha]['T1'];
        $div .= $turnosHtml[$fecha]['T2'];
        $div .= "</div>";

        if (Auth::user()->isAdmin()) {
            $div .= "<form id=\"formmodif-$day\" method=\"POST\" action=\"/turno/$sede_id/$year/$month\">";
            $div .= '<input name="_method" type="hidden" value="PUT">';
            $div .= "<div id=\"selectturnosdia-$day\" class=\"selectturnosdia\">";
            $div .= $turnosHtmlSelect[$fecha];
            $div .= "</div>";
            $div .= $this->getHtmlBotonesModificar($day);
            $div .= "</form>";
            $div .= "<form id=\"formincid-$day\" method=\"POST\" action=\"/incidencia/$sede_id/$year/$month\">";
            $div .= '<input name="_method" type="hidden" value="PUT">';
            $div .= "<div id=\"incidenciasdia-$day\" class=\"incidenciasdia\">";
            $div .= $this->getHtmlTurnosSelect($day);
            $div .= "</div>";
            $div .= $this->getHtmlBotonesIncidencias($day);
            $div .= "</form>";
        }

        return $div;
    }

    public function getHtmlTurnosSelect($day) {
        $tipoturnos = array('M1' => 'Mañana 1', 'M2' => 'Mañana 2', 'T1' => 'Tarde 1', 'T2' => 'Tarde 2');

        $div = '<div class="">';
        $div .= "<select onchange=\"selectIncidenciaChange('$day')\" class=\"select_prof\" id=\"turno_id-$day\" name=\"turno_id-$day\">";

        foreach($tipoturnos as $i => $tipo) {
            $div .= "<option value=\"$i\">$tipo</option>";
        }

        $div .= "</select>";
        $div .= "<textarea id='incidencia_text-$day' name='incidencia_text'></textarea>";
        $div .= '</div>';

        return $div;
    }

    public function updateIncidencia($sede_id, $year, $month) {

        foreach(Input::all() as $key => $value) {

            if (strpos($key, 'turno_id') === 0) {
                $day = explode("-", $key)[1];
                $turno = $value;
                break;
            }
        }

        $eventdate = date('Y-m-d', mktime(0, 0, 0, $month, $day, $year));
        $evento = Turnos::where(array('fecha_turno' => $eventdate, 'tipo_turno' => $turno, 'sede_id' => $sede_id))->firstOrFail();

        $incidencia_text = Input::get('incidencia_text', FALSE);

        // Se borra la incidencia
        if ($incidencia_text === FALSE || $incidencia_text == '') {
            $evento->incidencia = 0;
            $evento->incidencia_text = '';
        } else {
            $evento->incidencia = 1;
            $evento->incidencia_text = $incidencia_text;
        }

        $evento->update();

        return Redirect::action('TurnoController@showMonth', array($sede_id, $year, $month));
    }


    public function edit($id) {

    }

    /* */
    private function getHtmlBotonesModificar($day) {
        $botones = "<div>";
        $botones .= "<button id='modifbutton-$day' type='button' class='botonl' onclick='modificarTurnoClick(\"$day\")'>Modificar</button>";
        $botones .= "<input id='modifbuttons-$day' form='formmodif-$day' class='botonl modifsavebutton' type='submit' value='Guardar'>";
        $botones .= "<button id='modifbuttonc-$day' type='button' class='botonl modifcancelbutton' onclick='modificarTurnoCancel(\"$day\")'>Cancelar</button>";
        $botones .= "</div>";
        return $botones;
    }

    private function getHtmlBotonesIncidencias($day) {
        $botones = "<div>";
        $botones .= "<input id='incidbuttons-$day' form='formincid-$day' class='botonl incidsavebutton' type='submit' value='Guardar'>";
        $botones .= "<button id='incidbutton-$day' type='button' class='botonl' onclick='incidenciaClick(\"$day\")'>Incidencias</button>";
        $botones .= "<button id='incidbuttonc-$day' type='button' class='botonl incidcancelbutton' onclick='incidenciaCancel(\"$day\")'>Cancelar</button>";
        $botones .= "</div>";
        return $botones;
    }

    private function getHtmlProfesionalesSedeSelects($sede_id, $turnos, $add_empty = TRUE) {
        $options = $this->getHtmlProfOptions($turnos, $add_empty, $sede_id);

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

    /* Cada fila con el nombre del profesional en una casilla del calendario */
    private function getHtmlProfRow($turno, $profesional) {
        $tipo = $turno->tipo_turno;
        $fecha = $turno->fecha_turno;
        $incidencia = $turno->incidencia == 0 ? "" : "turnoincidencia";

        $div = "";
        $day = explode('-', $fecha)[2];
        $div .= "<div id='rowturno-$day-$tipo' class='rowturno $incidencia'>";
        if ($profesional !== null ){
            $div .= "$tipo: $profesional->nombre $profesional->apellido1";
        } else {
            $div .= "$tipo: Sin asignar";
        }

        $div .= '</div>';
        return $div;
    }

    /* Crea un array con los <option> para los turnos de cada día */
    private function getHtmlProfOptions($turnos, $add_empty, $sede_id) {

        $profesionales = Profesional::leftJoin('sedes_profesionales', 'sedes_profesionales.profesional_id', '=', 'profesionales.id')
                            ->where('sedes_profesionales.sede_id', $sede_id)
                            ->select('profesionales.id', 'profesionales.apellido1', 'profesionales.nombre')
                            ->get();

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
        $div .= $tipo . ': <select class="select_prof" name="profesional_id-' . $day . '-' . $tipo . '">' . $options . "</select>";
        $div .= '</div>';
        return $div;
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

    public function updateMonth($sede_id, $year, $month) {

        $changes = array(); // changes per weekday
        $daychanged = 0;
        foreach(Input::all() as $key => $profesional_id) {

            // TODO: $value == "0"
            if (strpos($key, 'profesional_id') === 0) {
                $values = explode("-", $key); // profesional_id-DD-TT
                $day = $values[1];
                $turno = $values[2];

                $weekdaynum = date('w', mktime(0, 0, 0, $month, $day, $year)); // 0 (domingo) - 6 (sábado)
                $daychanged = $weekdaynum;
                $changes[$turno] = $profesional_id;

                $eventdate = date('Y-m-d', mktime(0, 0, 0, $month, $day, $year));

                $evento = Turnos::where(array('fecha_turno' => $eventdate, 'tipo_turno' => $turno, 'sede_id' => $sede_id))->firstOrFail();
                $evento->profesional_id = $profesional_id;
                $evento->update();
            }
        }

        // Cambiar los siguientes: $today + 7
        $date = strtotime("+1 day", date('U', mktime(0, 0, 0, $month, $day, $year)));
        $nextdate = date('Y-m-d', $date);

        $turnos = Turnos::where('fecha_turno', '>=', $nextdate)->where('sede_id', $sede_id)->get();
        foreach($turnos as $turno) {
            $date = explode('-', $turno->fecha_turno);
            $weekdaynum = date('w', mktime(0, 0, 0, $date[1], $date[2], $date[0]));
            if ($weekdaynum == $daychanged) {
                $turno->profesional_id = $changes[$turno->tipo_turno];
                $turno->update();
            }
        }

        return Redirect::action('TurnoController@showMonth', array($sede_id, $year, $month));
    }

    public function update($id)
    {

    }

    public function destroy($id)
    {
        //
    }


}
